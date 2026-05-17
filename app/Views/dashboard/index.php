<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value"><?= $total_mhs ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Dosen</div>
            <div class="stat-value"><?= $total_dosen ?></div>
        </div>
         <div class="stat-card">
            <div class="stat-label">Total Matakuliah</div>
            <div class="stat-value"><?= $total_mk ?></div>
        </div>
    </div>

    <!-- Tambahkan Card Baru untuk Diagram -->
    <div class="card" style="margin-bottom: 20px;">
        <h3>Grafik Rata-rata IPK Mahasiswa</h3>
        <div style="position: relative; height:40vh; width:100%">
            <!-- Elemen Canvas Tempat Diagram Digambar -->
            <canvas id="chartIpk"></canvas>
        </div>
    </div>

    <div class="card">
        <h3>Rekap Nilai (vw_rekap_ipk)</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekap_ipk as $r): ?>
                <tr>
                    <td><?= $r['nama_mahasiswa'] ?></td>
                    <td><?= $r['rata_rata'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- SCRIPT UNTUK MERENDER DIAGRAM -->
    <!-- Load Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // 1. Ekstrak data dari PHP foreach langsung ke Array JavaScript
        const namaMahasiswa = [
            <?php foreach ($rekap_ipk as $r) { echo '"' . $r['nama_mahasiswa'] . '",'; } ?>
        ];
        
        const rataRataIpk = [
            <?php foreach ($rekap_ipk as $r) { echo $r['rata_rata'] . ','; } ?>
        ];

        // 2. Konfigurasi dan Render Chart.js
        const ctx = document.getElementById('chartIpk').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Kamu bisa ganti jadi 'line' jika ingin grafik garis
            data: {
                labels: namaMahasiswa, // Nama-nama mahasiswa sebagai sumbu X
                datasets: [{
                    label: 'Rata-rata IPK',
                    data: rataRataIpk, // Nilai IPK sebagai sumbu Y
                    backgroundColor: 'rgba(3, 95, 49, 0.6)', // Warna isi batang (Biru transparan)
                    borderColor: 'rgba(78, 115, 223, 1)',      // Warna border batang
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4 // Karena standar IPK maksimal 4
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
<?= $this->endSection() ?>