<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Muzaki_model;

class Muzaki extends BaseController
{
    protected $muzakiModel;
    protected $session;

    public function __construct()
    {
        $this->muzakiModel = new Muzaki_model();
        $this->session = \Config\Services::session();
    }

    /**
     * Menampilkan daftar Muzaki
     */
    public function index()
    {
        checklogin();
        $muzakiData = $this->muzakiModel->getAllMuzaki();

        $data = [
            'title'   => 'Daftar Muzaki',
            'muzaki'  => $muzakiData,
            'content' => 'admin/muzaki/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    /**
     * Menambahkan data Muzaki
     */
    public function add()
    {
        checklogin();

        // Validasi input
        if ($this->request->getMethod() === 'post' && $this->validate([
            'noanggota' => 'required',
            'username'  => 'required',
            'password'  => 'required',
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
                $fileFoto->move(ROOTPATH . 'public/assets/upload/muzaki/', $namaFoto); // Simpan file di folder

            } else {
                // Jika gagal upload, kembalikan ke halaman add dengan error
                $this->session->setFlashdata('error', 'Gagal mengupload foto: ' . $fileFoto->getErrorString());
                return redirect()->back()->withInput();
            }

            // Simpan data ke database
            $this->muzakiModel->addMuzaki([
                'noanggota'    => $this->request->getPost('noanggota'),
                'username'     => $this->request->getPost('username'),
                'password'     => sha1($this->request->getPost('password')),
                'tipeanggota'  => $this->request->getPost('tipeanggota'),
                'nama'         => $this->request->getPost('nama'),
                'nik'          => $this->request->getPost('nik'),
                'alamat'       => $this->request->getPost('alamat'),
                'nohp'         => $this->request->getPost('nohp'),
                'keterangan'   => $this->request->getPost('keterangan'),
                'foto'         => $namaFoto, // Simpan nama file foto ke database
            ]);

            // Tampilkan notifikasi sukses
            $this->session->setFlashdata('sukses', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('admin/muzaki'));
        }

        // Jika validasi gagal, kembalikan ke halaman tambah dengan error
        $data = [
            'title'   => 'Tambah Data Muzaki',
            'content' => 'admin/muzaki/add',
            'validation' => $this->validator, // Kirim error validasi ke view
        ];

        echo view('admin/layout/wrapper', $data);
    }

    /**
     * Menampilkan halaman edit data Muzaki
     */
    public function edit($id)
{
    checklogin();

    // Ambil data Muzaki berdasarkan ID
    $muzaki = $this->muzakiModel->getMuzakiById($id);

    // Cek apakah data ditemukan
    if (!$muzaki) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Muzaki tidak ditemukan');
    }

    // Validasi input dan simpan data jika ada
    if ($this->request->getMethod() === 'post' && $this->validate([
        'noanggota' => 'required',
        'username'  => 'required',
        'nama'      => 'required',
        'nik'       => 'required',
        'alamat'    => 'required',
        'nohp'      => 'required',
        'foto'      => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,9096]', // Foto opsional
    ])) {
        // Proses upload foto jika ada
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $muzaki['foto']; // Gunakan foto lama jika tidak ada foto baru

        // Jika ada file yang diunggah
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // Hapus foto lama jika ada
            if (file_exists(ROOTPATH . 'public/assets/upload/muzaki/' . $muzaki['foto'])) {
                unlink(ROOTPATH . 'public/assets/upload/muzaki/' . $muzaki['foto']);
            }

            $namaFoto = $fileFoto->getRandomName(); // Generate nama unik
            $fileFoto->move(ROOTPATH . 'public/assets/upload/muzaki/', $namaFoto); // Simpan file di folder
        }

        // Simpan data yang sudah diubah
        $this->muzakiModel->updateMuzaki($id, [
            'noanggota'    => $this->request->getPost('noanggota'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password') ? sha1($this->request->getPost('password')) : $muzaki['password'], // Jika password kosong, gunakan password lama
            'tipeanggota'  => $this->request->getPost('tipeanggota'),
            'nama'         => $this->request->getPost('nama'),
            'nik'          => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'nohp'         => $this->request->getPost('nohp'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'foto'         => $namaFoto, // Simpan nama file foto baru ke database
        ]);

        // Tampilkan notifikasi sukses
        $this->session->setFlashdata('sukses', 'Data berhasil diperbarui');
        return redirect()->to(base_url('admin/muzaki'));
    }

    // Jika form belum disubmit atau validasi gagal, tampilkan form edit
    $data = [
        'title'   => 'Edit Data Muzaki',
        'muzaki'  => $muzaki,
        'content' => 'admin/muzaki/edit',
        'validation' => $this->validator, // Kirim error validasi ke view
    ];

    echo view('admin/layout/wrapper', $data);
}


    /**
     * Menghapus data Muzaki berdasarkan ID
     */
    public function delete($id)
    {
        checklogin();
        $this->muzakiModel->deleteMuzaki($id);
        $this->session->setFlashdata('sukses', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/muzaki'));
    }
}
