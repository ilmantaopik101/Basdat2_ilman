<?php
namespace App\Controllers;
use App\Models\TugasBesarModel;

class Nilai extends BaseController {
    protected $model;
    protected $db;

    public function __construct() {
        $this->model = new TugasBesarModel();
        $this->db    = \Config\Database::connect();
    }

    public function index() {
        // Bab 4 — JOIN Mahasiswa, Nilai, Kelas, Mata Kuliah
        $data['nilai'] = $this->db->query(
            "SELECT n.id_nilai, m.nama_mahasiswa,
                    mk.nama_mk, n.nilai_akhir,
                    fn_grade(n.nilai_akhir) AS grade
             FROM nilai n
             JOIN mahasiswa m ON n.nim = m.nim
             JOIN kelas k ON n.id_kelas = k.id_kelas
             JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk
             ORDER BY m.nama_mahasiswa"
        )->getResultArray();

        return view('nilai/index', $data);
    }

    // BAB 9 — Transaction: simpan nilai

    public function tambah() {
        $db = \Config\Database::connect();
        $data['mahasiswa'] = $db->table('mahasiswa')->get()->getResultArray();
        $data['kelas'] = $db->table('kelas')->get()->getResultArray();
        return view('nilai/form', $data);
    }
    
    // Fungsi Simpan sudah ada di modul (yang pakai transStart)

    public function simpan() {
        $nim   = $this->request->getPost('nim');
        $kelas = (int)$this->request->getPost('id_kelas');
        $nilai = (float)$this->request->getPost('nilai_akhir');

        if ($nilai < 0 || $nilai > 100) {
            return redirect()->back()->with('error',
                'Nilai harus antara 0 dan 100!');
        }

        // Mulai Transaction
        $this->db->transStart();
        $this->db->query(
            "INSERT INTO nilai (nim, id_kelas, nilai_akhir)
             VALUES (?, ?, ?)",
            [$nim, $kelas, $nilai]
        );

        $this->db->transComplete(); // Cek apakah semua query sukses

    if ($this->db->transStatus() === false) {
        // Jika ada yang gagal, otomatis ROLLBACK
        return redirect()->back()->with('error', 'Transaksi Gagal! Data dibatalkan.');
    }

    // Jika sukses, otomatis COMMIT
    return redirect()->to('/nilai')->with('success', 'Data Nilai Berhasil Disimpan!');

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->back()->with('error',
                'Transaksi gagal, data tidak disimpan!');
        }

        // Trigger trg_validasi_insert otomatis berjalan di MySQL
        return redirect()->to('/nilai')
            ->with('success', 'Nilai berhasil disimpan');
    }

    // Fitur Hapus (Bab 3 - DML)
    public function hapus($id)
    {
        // Gunakan Transaction untuk memastikan penghapusan aman
        $this->db->transStart();

        // Query DELETE berdasarkan ID Nilai
        $this->db->query("DELETE FROM nilai WHERE id_nilai = ?", [$id]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return redirect()->to('/nilai')->with('error', 'Gagal menghapus data!');
        }

        return redirect()->to('/nilai')->with('success', 'Data nilai berhasil dihapus (Log tercatat)');
    }

    public function log() {
        $db = \Config\Database::connect();
        // Mengambil data log terbaru (Bab 9)
        $data['logs'] = $db->table('log_perubahan_nilai')
                       ->orderBy('waktu', 'DESC')
                       ->get()->getResultArray();
        $data['title'] = "History Log Nilai";

        return view('nilai/log', $data);
    }
}
