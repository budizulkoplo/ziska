<?php

namespace App\Controllers\Admin;

use App\Models\TransaksiModel;
use App\Models\KodetransaksiModel; 

class Transaksi extends BaseController
{
    // Menampilkan daftar transaksi
    public function index()
{
    checklogin(); // Pastikan pengguna sudah login
    $m_transaksi = new \App\Models\TransaksiModel();
    $m_muzaki = new \App\Models\Muzaki_model();

    if (session('akses_level') !== 'muzaki') {
        // Ambil data transaksi dengan join ke tabel muzaki
        $transaksi = $m_transaksi
            ->select('transaksi.*, muzaki.nama AS nama_muzaki')
            ->join('muzaki', 'muzaki.username = transaksi.muzaki', 'left')
            ->findAll();
    } else {
        // Ambil data transaksi hanya untuk muzaki yang sedang login
        $transaksi = $m_transaksi
            ->where('muzaki', session('username'))
            ->findAll();
    }

    $data = [
        'title'     => (session('akses_level') === 'muzaki') ? 'Riwayat Transaksi' : 'Daftar Transaksi',
        'transaksi' => $transaksi, 
        'content'   => (session('akses_level') === 'muzaki') ? 'admin/transaksi/riwayat' : 'admin/transaksi/index',
    ];

    echo view('admin/layout/wrapper', $data);
}


    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_kodetransaksi = new KodetransaksiModel();
        
        // Ambil hanya kodetransaksi dengan cashflow 'Pemasukan'
        $kodetransaksi = $m_kodetransaksi->where('cashflow', 'Pemasukan')->findAll(); 

        $data = [
            'title'       => 'Tambah Transaksi',
            'kodetransaksi' => $kodetransaksi, // Mengirimkan data kodetransaksi yang telah difilter ke view
            'content'     => 'admin/transaksi/create',  // View untuk form tambah transaksi
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function zakat()
{
    checklogin();  // Pastikan pengguna sudah login
    $m_kodetransaksi = new KodetransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();

    // Ambil idrekening dari tabel m_kodetransaksi untuk kodetransaksi = 'Zakat'
    $kodetransaksi = $m_kodetransaksi->where('kodetransaksi', 'Zakat')->findAll();

    $idRekeningList = array_column($kodetransaksi, 'idrekening');

    // Ambil data rekening yang sesuai dengan idrekening dari kodetransaksi
    $rekening = $m_rekening->whereIn('idrek', $idRekeningList)->findAll();

    $data = [
        'title'       => 'Bayar Zakat',
        'kodetransaksi' => $kodetransaksi, // Data kode transaksi
        'rekening'    => $rekening,       // Rekening yang terkait dengan Zakat
        'content'     => 'admin/transaksi/zakat',  // View untuk form tambah transaksi
    ];

    echo view('admin/layout/wrapper', $data);
}



    // Menyimpan data transaksi baru
    public function store()
{
    checklogin();  // Pastikan pengguna sudah login

    $m_transaksi = new TransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();
    $m_log = new \App\Models\TransactionLogModel();
    $m_kodetransaksi = new \App\Models\KodeTransaksiModel();

    // Validasi input
    if (!$this->validate([
        'tipetransaksi' => 'required|string|max_length[50]',
        'tgltransaksi'  => 'required|valid_date',
        'muzaki'        => 'required|string|max_length[100]',
        'nominal'       => 'required|decimal',
        'keterangan'    => 'permit_empty|string|max_length[255]',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $tipetransaksi = $this->request->getPost('tipetransaksi');
    $nominal = $this->request->getPost('nominal');

    // Ambil data kode transaksi untuk mendapatkan idrek dan cashflow
    $kodeTransaksi = $m_kodetransaksi->where('kodetransaksi', $tipetransaksi)->first();
    if (!$kodeTransaksi) {
        return redirect()->back()->with('error', 'Kode transaksi tidak ditemukan.');
    }

    $idrek = $kodeTransaksi['idrekening'];
    $cashflow = $kodeTransaksi['cashflow'];

    // Ambil data rekening untuk validasi
    $rekening = $m_rekening->find($idrek);
    if (!$rekening) {
        return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
    }

    // Perhitungan saldo
    $saldoAwal = $rekening['saldoakhir'];
    $saldoAkhir = ($cashflow === 'Pemasukan') ? $saldoAwal + $nominal : $saldoAwal - $nominal;

    // Menyimpan data transaksi
    $dataTransaksi = [
        'tipetransaksi' => $tipetransaksi,
        'tgltransaksi'  => $this->request->getPost('tgltransaksi'),
        'muzaki'        => $this->request->getPost('muzaki'),
        'nominal'       => $nominal,
        'keterangan'    => $this->request->getPost('keterangan'),
        'idrek'         => $idrek,
        'cashflow'      => $cashflow,
        'status'        => 'sukses', // Langsung sukses karena input oleh admin
    ];
    $idtransaksi = $m_transaksi->insert($dataTransaksi);

    // Perbarui saldo akhir rekening
    $m_rekening->update($idrek, ['saldoakhir' => $saldoAkhir]);

    // Simpan log transaksi
    $dataLog = [
        'idtransaksi' => $idtransaksi,
        'idrek'       => $idrek,
        'nominal'     => $nominal,
        'saldoawal'   => $saldoAwal,
        'saldoakhir'  => $saldoAkhir,
        'cashflow'      => $cashflow,
    ];
    $m_log->insert($dataLog);

    $this->session->setFlashdata('sukses', 'Transaksi berhasil ditambahkan.');
    return redirect()->to(base_url('admin/transaksi'));
}

    // Menampilkan form untuk mengedit transaksi
    public function edit($idtransaksi)
{
    checklogin(); // Pastikan pengguna sudah login

    // Inisialisasi model yang diperlukan
    $m_transaksi = new \App\Models\TransaksiModel();
    $m_kodetransaksi = new \App\Models\KodeTransaksiModel();
    $m_muzaki = new \App\Models\Muzaki_model();

    // Ambil data transaksi berdasarkan ID
    $transaksi = $m_transaksi
        ->select('transaksi.*, muzaki.nama AS nama_muzaki') // Pilih field tambahan dari tabel muzaki
        ->join('muzaki', 'muzaki.username = transaksi.muzaki', 'left') // Join dengan tabel muzaki
        ->where('transaksi.idtransaksi', $idtransaksi)
        ->first();

    if (!$transaksi) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi dengan ID ' . $idtransaksi . ' tidak ditemukan.');
    }

    // Ambil data kode transaksi untuk dropdown
    $kodetransaksi = $m_kodetransaksi->findAll();

    // Data yang akan dikirim ke view
    $data = [
        'title'         => 'Edit Transaksi',
        'transaksi'     => $transaksi,         // Data transaksi yang sedang diedit
        'kodetransaksi' => $kodetransaksi,     // Data kode transaksi untuk dropdown
        'content'       => 'admin/transaksi/edit', // View untuk form edit
    ];

    // Render view dengan wrapper
    return view('admin/layout/wrapper', $data);
}

    // Menyimpan perubahan data transaksi
    public function update($idtransaksi)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_transaksi = new TransaksiModel();

        // Validasi input
        if (!$this->validate([
            'tipetransaksi' => 'required|string|max_length[50]',
            'tgltransaksi'  => 'required|valid_date',
            'muzaki'        => 'required|string|max_length[100]',
            'nominal'       => 'required|decimal',
            'keterangan'    => 'permit_empty|string|max_length[255]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'tipetransaksi' => $this->request->getPost('tipetransaksi'),
            'tgltransaksi'  => $this->request->getPost('tgltransaksi'),
            'muzaki'        => $this->request->getPost('muzaki'),
            'nominal'       => $this->request->getPost('nominal'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $m_transaksi->update($idtransaksi, $data);

        $this->session->setFlashdata('sukses', 'Transaksi berhasil diperbarui');

        return redirect()->to(base_url('admin/transaksi'));
    }

    public function bayarzakat()
{
    checklogin(); // Pastikan pengguna sudah login

    // Model yang dibutuhkan
    $m_transaksi = new \App\Models\TransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();
    $m_kodetransaksi = new \App\Models\KodeTransaksiModel(); // Model untuk kode transaksi

    // Validasi input
    if (!$this->validate([
        'tgltransaksi' => 'required|valid_date',
        'idrek'        => 'required',
        'nominal'      => 'required|decimal|greater_than[0]',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $idrek = $this->request->getPost('idrek');
    $nominal = $this->request->getPost('nominal');

    // Ambil data rekening untuk validasi
    $rekening = $m_rekening->find($idrek);
    if (!$rekening) {
        return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
    }

    // Ambil data cashflow dari tabel m_kodetransaksi
    $kodeTransaksi = $m_kodetransaksi->where('kodetransaksi', 'Zakat')->first(); // Sesuaikan 'Zakat' sebagai tipe transaksi
    if (!$kodeTransaksi) {
        return redirect()->back()->with('error', 'Kode transaksi tidak ditemukan.');
    }
    $cashflow = $kodeTransaksi['cashflow']; // Ambil nilai cashflow

    // Simpan transaksi dengan status 'pending'
    $dataTransaksi = [
        'tipetransaksi' => 'Zakat',
        'tgltransaksi'  => $this->request->getPost('tgltransaksi'),
        'muzaki'        => $this->session->get('username'),
        'nominal'       => $nominal,
        'keterangan'    => $this->request->getPost('keterangan'),
        'zakat'         => $this->request->getPost('jeniszakat'),
        'idrek'         => $idrek,
        'cashflow'      => $cashflow, // Simpan cashflow
        'status'        => 'pending', // Status awal
    ];
    $idtransaksi = $m_transaksi->insert($dataTransaksi);

    $this->session->setFlashdata('sukses', 'Pembayaran zakat berhasil disimpan dengan status pending.');
    return redirect()->to(base_url('admin/transaksi'));
}


public function updateStatusTransaksi($idtransaksi)
{
    checklogin(); // Pastikan pengguna sudah login

    // Model yang dibutuhkan
    $m_transaksi = new \App\Models\TransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();
    $m_log = new \App\Models\TransactionLogModel();
    $m_kodetransaksi = new \App\Models\KodeTransaksiModel();

    // Validasi input status
    $statusBaru = $this->request->getPost('status');
    if (!in_array($statusBaru, ['pending', 'verifikasi', 'sukses'])) {
        return redirect()->back()->with('error', 'Status tidak valid.');
    }

    // Ambil data transaksi
    $transaksi = $m_transaksi->find($idtransaksi);
    if (!$transaksi) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    }

    $statusLama = $transaksi['status']; // Status sebelumnya
    $tipetransaksi = $transaksi['tipetransaksi'];

    // Ambil informasi cashflow berdasarkan tipe transaksi
    $kodetransaksi = $m_kodetransaksi->where('kodetransaksi', $tipetransaksi)->first();
    if (!$kodetransaksi) {
        return redirect()->back()->with('error', 'Tipe transaksi tidak valid.');
    }

    $cashflow = $kodetransaksi['cashflow']; // Bisa 'Pemasukan' atau 'Pengeluaran'

    // Jika status tidak berubah, tidak perlu melakukan apa-apa
    if ($statusBaru === $statusLama) {
        return redirect()->back()->with('info', 'Status tidak berubah.');
    }

    // Ambil data rekening jika diperlukan
    $idrek = $transaksi['idrek'];
    $rekening = $m_rekening->find($idrek);
    if (!$rekening) {
        return redirect()->back()->with('error', 'Rekening tidak ditemukan.');
    }

    $nominal = $transaksi['nominal'];

    // Perhitungan saldo berdasarkan perubahan status
    if ($statusLama === 'sukses' && $statusBaru !== 'sukses') {
        // Status berubah dari sukses ke selain sukses: batalkan perhitungan saldo
        $saldoakhir = $rekening['saldoakhir'];

        if ($cashflow === 'Pemasukan') {
            $saldoakhir -= $nominal; // Kurangi saldo untuk pembatalan pemasukan
        } elseif ($cashflow === 'Pengeluaran') {
            $saldoakhir += $nominal; // Tambah saldo untuk pembatalan pengeluaran
        }

        // Update saldo rekening
        $m_rekening->update($idrek, ['saldoakhir' => $saldoakhir]);

        // Hapus log transaksi
        $m_log->where('idtransaksi', $idtransaksi)->delete();
    } elseif ($statusLama !== 'sukses' && $statusBaru === 'sukses') {
        // Status berubah menjadi sukses: lakukan perhitungan saldo
        $saldoawal = $rekening['saldoakhir'];
        $saldoakhir = $saldoawal;

        if ($cashflow === 'Pemasukan') {
            $saldoakhir += $nominal; // Tambah saldo untuk pemasukan
        } elseif ($cashflow === 'Pengeluaran') {
            $saldoakhir -= $nominal; // Kurangi saldo untuk pengeluaran
        }

        // Update saldo rekening
        $m_rekening->update($idrek, ['saldoakhir' => $saldoakhir]);

        // Simpan log transaksi
        $dataLog = [
            'idtransaksi' => $idtransaksi,
            'idrek'       => $idrek,
            'nominal'     => $nominal,
            'saldoawal'   => $saldoawal,
            'saldoakhir'  => $saldoakhir,
            'cashflow'    => $cashflow,
        ];
        $m_log->insert($dataLog);
    }

    // Update status transaksi
    $m_transaksi->update($idtransaksi, ['status' => $statusBaru]);

    $this->session->setFlashdata('sukses', 'Status transaksi berhasil diperbarui.');
    return redirect()->to(base_url('admin/transaksi'));
}




public function delete($idtransaksi)
{
    checklogin(); // Pastikan pengguna sudah login
    $m_transaksi = new \App\Models\TransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();
    $m_log = new \App\Models\TransactionLogModel();

    $transaksi = $m_transaksi->find($idtransaksi);
    if (!$transaksi) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan.');
    }

    // Periksa apakah status transaksi adalah 'sukses'
    if ($transaksi['status'] === 'sukses') {
        // Ambil log transaksi
        $log = $m_log->where('idtransaksi', $idtransaksi)->first();
        if (!$log) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Log transaksi tidak ditemukan.');
        }

        $idrek = $log['idrek'];
        $saldoakhir_sebelum = $log['saldoawal'];

        // Update saldo rekening ke saldo sebelum transaksi
        $m_rekening->update($idrek, ['saldoakhir' => $saldoakhir_sebelum]);

        // Hapus log transaksi
        $m_log->delete($log['id']);
    }

    // Hapus transaksi
    $m_transaksi->delete($idtransaksi);

    $this->session->setFlashdata('sukses', 'Transaksi berhasil dihapus.');
    return redirect()->to(base_url('admin/transaksi'));
}


}
