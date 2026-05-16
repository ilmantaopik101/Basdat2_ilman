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
<?= $this->endSection() ?>