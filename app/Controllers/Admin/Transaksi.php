<?php

namespace App\Controllers\Admin;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    // Menampilkan daftar transaksi
    public function index()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_transaksi = new TransaksiModel();
        $transaksi   = $m_transaksi->findAll();  // Mengambil semua data transaksi

        $data = [
            'title'    => 'Daftar Transaksi',
            'transaksi' => $transaksi,  // Data transaksi
            'content'  => 'admin/transaksi/index',  // View yang digunakan
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menampilkan form untuk menambah transaksi
    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $data = [
            'title'   => 'Tambah Transaksi',
            'content' => 'admin/transaksi/create',  // View untuk form tambah transaksi
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan data transaksi baru
    public function store()
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

        // Menyimpan data transaksi
        $data = [
            'tipetransaksi' => $this->request->getPost('tipetransaksi'),
            'tgltransaksi'  => $this->request->getPost('tgltransaksi'),
            'muzaki'        => $this->request->getPost('muzaki'),
            'nominal'       => $this->request->getPost('nominal'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $m_transaksi->insert($data);

        $this->session->setFlashdata('sukses', 'Transaksi berhasil ditambahkan');

        return redirect()->to(base_url('admin/transaksi'));
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($idtransaksi)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_transaksi = new TransaksiModel();
        $transaksi   = $m_transaksi->find($idtransaksi);  // Mengambil data transaksi berdasarkan ID

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi dengan ID ' . $idtransaksi . ' tidak ditemukan');
        }

        $data = [
            'title'     => 'Edit Transaksi',
            'transaksi' => $transaksi,  // Data transaksi untuk diubah
            'content'   => 'admin/transaksi/edit',  // View untuk form edit transaksi
        ];
        echo view('admin/layout/wrapper', $data);
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

    // Menghapus transaksi
    public function delete($idtransaksi)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_transaksi = new TransaksiModel();
        $transaksi   = $m_transaksi->find($idtransaksi);  // Mengambil data transaksi berdasarkan ID

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi dengan ID ' . $idtransaksi . ' tidak ditemukan');
        }

        $m_transaksi->delete($idtransaksi);  // Menghapus data transaksi berdasarkan ID

        $this->session->setFlashdata('sukses', 'Transaksi berhasil dihapus');

        return redirect()->to(base_url('admin/transaksi'));
    }
}
