<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Mustahik_model;

class Mustahik extends BaseController
{
    protected $mustahikModel;
    protected $session;

    public function __construct()
    {
        $this->mustahikModel = new Mustahik_model();
        $this->session = \Config\Services::session();
    }

    /**
     * Menampilkan daftar mustahik
     */
    public function index()
    {
        checklogin();
        $mustahikData = $this->mustahikModel->getAllmustahik();

        $data = [
            'title'   => 'Daftar mustahik',
            'mustahik'  => $mustahikData,
            'content' => 'admin/mustahik/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    /**
     * Menambahkan data mustahik
     */
    public function add()
    {
        checklogin();

        // Validasi input
        if ($this->request->getMethod() === 'post' && $this->validate([
           
            'nama'      => 'required',
            'nik'       => 'required',
            'alamat'    => 'required',
            'nohp'      => 'required',
            'foto'      => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]',
        ])) {
            // Proses upload file foto
            $fileFoto = $this->request->getFile('foto');
            $namaFoto = '';

            // Cek apakah file berhasil diunggah
            if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFoto = $fileFoto->getRandomName(); // Generate nama unik
                $fileFoto->move(ROOTPATH . 'assets/upload/image/', $namaFoto); // Simpan file di folder

            } else {
                // Jika gagal upload, kembalikan ke halaman add dengan error
                $this->session->setFlashdata('error', 'Gagal mengupload foto: ' . $fileFoto->getErrorString());
                return redirect()->back()->withInput();
            }

            // Simpan data ke database
            $this->mustahikModel->addmustahik([
                
                'nama'         => $this->request->getPost('nama'),
                'nik'          => $this->request->getPost('nik'),
                'alamat'       => $this->request->getPost('alamat'),
                'nohp'         => $this->request->getPost('nohp'),
                'keterangan'   => $this->request->getPost('keterangan'),
                'foto'         => $namaFoto, // Simpan nama file foto ke database
            ]);

            // Tampilkan notifikasi sukses
            $this->session->setFlashdata('sukses', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('admin/mustahik'));
        }

        // Jika validasi gagal, kembalikan ke halaman tambah dengan error
        $data = [
            'title'   => 'Tambah Data mustahik',
            'content' => 'admin/mustahik/add',
            'validation' => $this->validator, // Kirim error validasi ke view
        ];

        echo view('admin/layout/wrapper', $data);
    }

    /**
     * Menampilkan halaman edit data mustahik
     */
    public function edit($idmustahik)
{
    checklogin();

    // Ambil data mustahik berdasarkan ID
    $mustahik = $this->mustahikModel->getmustahikById($idmustahik);

    // Cek apakah data ditemukan
    if (!$mustahik) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('mustahik tidak ditemukan');
    }

    // Validasi input dan simpan data jika ada
    if ($this->request->getMethod() === 'post' && $this->validate([
        'nama'      => 'required',
        'nik'       => 'required',
        'alamat'    => 'required',
        'nohp'      => 'required',
        'foto'      => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,9096]', // Foto opsional
    ])) {
        // Proses upload foto jika ada
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $mustahik['foto']; // Gunakan foto lama jika tidak ada foto baru

        // Jika ada file yang diunggah
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // Hapus foto lama jika ada
            if (file_exists(ROOTPATH . 'assets/upload/image/' . $mustahik['foto'])) {
                unlink(ROOTPATH . 'assets/upload/image/' . $mustahik['foto']);
            }

            $namaFoto = $fileFoto->getRandomName(); // Generate nama unik
            $fileFoto->move(ROOTPATH . 'assets/upload/image/', $namaFoto); // Simpan file di folder
        }

        // Simpan data yang sudah diubah
        $this->mustahikModel->updatemustahik($idmustahik, [
           
            'nama'         => $this->request->getPost('nama'),
            'nik'          => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'nohp'         => $this->request->getPost('nohp'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'foto'         => $namaFoto, // Simpan nama file foto baru ke database
        ]);

        // Tampilkan notifikasi sukses
        $this->session->setFlashdata('sukses', 'Data berhasil diperbarui');
        return redirect()->to(base_url('admin/mustahik'));
    }

    // Jika form belum disubmit atau validasi gagal, tampilkan form edit
    $data = [
        'title'   => 'Edit Data mustahik',
        'mustahik'  => $mustahik,
        'content' => 'admin/mustahik/edit',
        'validation' => $this->validator, // Kirim error validasi ke view
    ];

    echo view('admin/layout/wrapper', $data);
}


    /**
     * Menghapus data mustahik berdasarkan ID
     */
    public function delete($idmustahik)
    {
        checklogin();
        $this->mustahikModel->deletemustahik($idmustahik);
        $this->session->setFlashdata('sukses', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/mustahik'));
    }
}
