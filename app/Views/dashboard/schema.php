<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

<div style="display: flex; width: 100%; align-items: stretch;">

    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">U</div>
            <span>SIAKAD UNIPI</span>
        </div>
        <nav>
            <a href="<?= base_url('/') ?>" class="nav-item">Dashboard (Bab 1)</a>
            <a href="<?= base_url('dashboard/schema/mahasiswa') ?>" class="nav-item">Schema DB (Bab 2)</a>
            <a href="<?= base_url('mahasiswa') ?>" class="nav-item">Mahasiswa (Bab 3)</a>
            <a href="<?= base_url('dosen') ?>" class="nav-item">Dosen (Bab 3)</a>
            <a href="<?= base_url('matakuliah') ?>" class="nav-item">Mata Kuliah (Bab 3)</a>
            <a href="<?= base_url('nilai') ?>" class="nav-item">Nilai (Bab 3)</a>
            <a href="<?= base_url('transkrip') ?>" class="nav-item">Transkrip (Bab 4)</a>
            <a href="<?= base_url('laporan') ?>" class="nav-item">Laporan (Bab 5-6)</a>
            <a href="<?= base_url('nilai/log') ?>" class="btn" style="background: #6B7280; color: white;">View Audit Log</a>
        </nav>
    </div>

    <div class="main-content" style="flex: 1;">
        <div class="card" style="width: 100%;">
            <h2 class="page-title">Struktur Tabel (Bab 2 - DDL)</h2>
            <p class="page-sub">Verifikasi struktur database menggunakan perintah DESCRIBE</p>
            
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                <a href="<?= base_url('dashboard/schema/mahasiswa') ?>" class="btn btn-primary">MAHASISWA</a>
                <a href="<?= base_url('dashboard/schema/dosen') ?>" class="btn btn-primary">DOSEN</a>
                <a href="<?= base_url('dashboard/schema/nilai') ?>" class="btn btn-primary">NILAI</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Type</th>
                        <th>Null</th>
                        <th>Key</th>
                        <th>Default</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fields as $f): ?>
                    <tr>
                        <td><strong><?= $f['Field'] ?></strong></td>
                        <td><?= $f['Type'] ?></td>
                        <td><?= $f['Null'] ?></td>
                        <td><span class="grade-B"><?= $f['Key'] ?></span></td>
                        <td><?= $f['Default'] ?: '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>