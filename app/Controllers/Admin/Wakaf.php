<?php

namespace App\Controllers\Admin;

use App\Models\WakafModel;

class Wakaf extends BaseController
{
    // Menampilkan daftar wakaf
    public function index()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->findAll();  // Mengambil semua data wakaf

        $data = [
            'title'   => 'Daftar Wakaf',
            'wakaf'   => $wakaf,  // Data wakaf
            'content' => 'admin/wakaf/index',  // View yang digunakan
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menampilkan form untuk menambah wakaf
    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $data = [
            'title'   => 'Tambah Wakaf',
            'content' => 'admin/wakaf/create',  // View untuk form tambah wakaf
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan data wakaf baru
    public function store()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();

        // Validasi input
        if (!$this->validate([
            'idobject'     => 'required|string|max_length[255]',
            'nosertifikat' => 'required|string|max_length[255]',
            'alamat'       => 'required|string',
            'koordinat'    => 'required|string|max_length[255]',
            'pewakaf'      => 'required|string|max_length[255]',
            'keterangan'   => 'permit_empty|string',
            'status'       => 'required|string|max_length[50]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Menyimpan data wakaf
        $data = [
            'idobject'     => $this->request->getPost('idobject'),
            'nosertifikat' => $this->request->getPost('nosertifikat'),
            'alamat'       => $this->request->getPost('alamat'),
            'koordinat'    => $this->request->getPost('koordinat'),
            'pewakaf'      => $this->request->getPost('pewakaf'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'status'       => $this->request->getPost('status'),
        ];

        $m_wakaf->insert($data);

        $this->session->setFlashdata('sukses', 'Wakaf berhasil ditambahkan');

        return redirect()->to(base_url('admin/wakaf'));
    }

    // Menampilkan form untuk mengedit wakaf
    public function edit($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->find($idwakaf);  // Mengambil data wakaf berdasarkan ID

        if (!$wakaf) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Wakaf dengan ID ' . $idwakaf . ' tidak ditemukan');
        }

        $data = [
            'title'   => 'Edit Wakaf',
            'wakaf'   => $wakaf,  // Data wakaf untuk diubah
            'content' => 'admin/wakaf/edit',  // View untuk form edit wakaf
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan perubahan data wakaf
    public function update($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();

        // Validasi input
        if (!$this->validate([
            'idobject'     => 'required|string|max_length[255]',
            'nosertifikat' => 'required|string|max_length[255]',
            'alamat'       => 'required|string',
            'koordinat'    => 'required|string|max_length[255]',
            'pewakaf'      => 'required|string|max_length[255]',
            'keterangan'   => 'permit_empty|string',
            'status'       => 'required|string|max_length[50]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'idobject'     => $this->request->getPost('idobject'),
            'nosertifikat' => $this->request->getPost('nosertifikat'),
            'alamat'       => $this->request->getPost('alamat'),
            'koordinat'    => $this->request->getPost('koordinat'),
            'pewakaf'      => $this->request->getPost('pewakaf'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'status'       => $this->request->getPost('status'),
        ];

        $m_wakaf->update($idwakaf, $data);

        $this->session->setFlashdata('sukses', 'Wakaf berhasil diperbarui');

        return redirect()->to(base_url('admin/wakaf'));
    }

    // Menghapus wakaf
    public function delete($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->find($idwakaf);  // Mengambil data wakaf berdasarkan ID

        if (!$wakaf) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Wakaf dengan ID ' . $idwakaf . ' tidak ditemukan');
        }

        $m_wakaf->delete($idwakaf);  // Menghapus data wakaf berdasarkan ID

        $this->session->setFlashdata('sukses', 'Wakaf berhasil dihapus');

        return redirect()->to(base_url('admin/wakaf'));
    }
}
