<?php

namespace App\Controllers\Admin;

use App\Models\RekeningModel;
use App\Models\LevelModel;

class Rekening extends BaseController
{
    // Halaman utama
    public function index()
    {
        checklogin();
        
        $m_rekening = new RekeningModel();
        $m_level = new LevelModel();

        $rekening = $m_rekening->findAll();
        $levels = $m_level->findAll(); // Ambil data level dari tabel level

        // Start validasi form untuk tambah data
        if ($this->request->getMethod() === 'post' && $this->validate([
            'norek' => 'required',
            'namarek' => 'required',
            'saldo' => 'required|numeric',
            'level' => 'required'
        ])) {
            // Simpan ke database
            $data = [
                'norek'        => $this->request->getPost('norek'),
                'namarek'      => $this->request->getPost('namarek'),
                'saldo'        => $this->request->getPost('saldo'),
                'saldoakhir'   => $this->request->getPost('saldo'), // Default awal sama dengan saldo
                'level'        => $this->request->getPost('level'),
            ];

            $m_rekening->save($data);
            $this->session->setFlashdata('sukses', 'Rekening baru berhasil ditambahkan.');

            return redirect()->to(base_url('admin/rekening'));
        }

        $data = [
            'title'    => 'Manajemen Rekening',
            'rekening' => $rekening,
            'levels'   => $levels, // Kirim data levels ke view
            'content'  => 'admin/rekening/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Edit rekening
    public function edit($idrek)
    {
        checklogin();

        $m_rekening = new RekeningModel();
        $m_level = new LevelModel();

        $rekening = $m_rekening->find($idrek);
        $levels = $m_level->findAll(); // Ambil data level untuk dropdown

        if (!$rekening) {
            $this->session->setFlashdata('error', 'Data rekening tidak ditemukan.');
            return redirect()->to(base_url('admin/rekening'));
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'norek' => 'required',
            'namarek' => 'required',
            'saldo' => 'required|numeric',
            'level' => 'required'
        ])) {
            $data = [
                'norek'        => $this->request->getPost('norek'),
                'namarek'      => $this->request->getPost('namarek'),
                'saldo'        => $this->request->getPost('saldo'),
                'saldoakhir'   => $this->request->getPost('saldoakhir'),
                'level'        => $this->request->getPost('level'),
            ];

            $m_rekening->update($idrek, $data);
            $this->session->setFlashdata('sukses', 'Data rekening berhasil diperbarui.');

            return redirect()->to(base_url('admin/rekening'));
        }

        $data = [
            'title'    => 'Edit Rekening',
            'rekening' => $rekening,
            'levels'   => $levels, // Kirim data levels ke view
            'content'  => 'admin/rekening/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Hapus rekening
    public function delete($idrek)
    {
        checklogin();
        $m_rekening = new RekeningModel();
        $rekening   = $m_rekening->find($idrek);

        if (!$rekening) {
            $this->session->setFlashdata('error', 'Data rekening tidak ditemukan.');
            return redirect()->to(base_url('admin/rekening'));
        }

        $m_rekening->delete($idrek);
        $this->session->setFlashdata('sukses', 'Data rekening berhasil dihapus.');

        return redirect()->to(base_url('admin/rekening'));
    }

    public function update($idrek)
{
    // Pastikan pengguna sudah login
    checklogin();

    // Model untuk rekening dan level
    $m_rekening = new RekeningModel();
    $m_level = new LevelModel();

    // Ambil data rekening berdasarkan idrek
    $rekening = $m_rekening->find($idrek);
    $levels = $m_level->findAll(); // Ambil data level untuk dropdown

    // Jika data rekening tidak ditemukan, arahkan kembali ke daftar rekening dengan pesan error
    if (!$rekening) {
        $this->session->setFlashdata('error', 'Data rekening tidak ditemukan.');
        return redirect()->to(base_url('admin/rekening'));
    }

    // Cek apakah form disubmit dan validasi inputnya
    if ($this->request->getMethod() === 'post' && $this->validate([
        'norek'    => 'required',
        'namarek'  => 'required',
        'saldo'    => 'required|numeric',
        'level'    => 'required'
    ])) {
        // Ambil data yang dikirim dari form
        $data = [
            'norek'      => $this->request->getPost('norek'),
            'namarek'    => $this->request->getPost('namarek'),
            'saldo'      => $this->request->getPost('saldo'),
            'level'      => $this->request->getPost('level'),
        ];

        // Update data rekening
        $m_rekening->update($idrek, $data);

        // Set flash message dan redirect ke halaman daftar rekening
        $this->session->setFlashdata('sukses', 'Data rekening berhasil diperbarui.');
        return redirect()->to(base_url('admin/rekening'));
    }

    // Jika form belum disubmit atau ada kesalahan, kirim data rekening dan levels ke view
    $data = [
        'title'    => 'Edit Rekening',
        'rekening' => $rekening,
        'levels'   => $levels, // Kirim data levels ke view
        'content'  => 'admin/rekening/edit',
    ];

    // Render halaman edit rekening
    echo view('admin/layout/wrapper', $data);
}

}
