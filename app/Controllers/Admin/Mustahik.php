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

    // Ambil idranting dari session
    $idranting = $this->session->get('idranting');

    // Ambil data mustahik berdasarkan idranting
    if ($idranting == 1) { // Jika idranting 1 (All), ambil semua data
        $mustahikData = $this->mustahikModel->getAllmustahik();
    } else { // Jika idranting selain 1, ambil data sesuai idranting
        $mustahikData = $this->mustahikModel->getMustahikByRanting($idranting);
    }

    // Ambil data ranting untuk dropdown atau referensi
    $rantingModel = new \App\Models\Ranting_model();
    $ranting = $rantingModel->findAll();

    $data = [
        'title'    => 'Daftar Mustahik',
        'mustahik' => $mustahikData,
        'ranting'  => $ranting,
        'content'  => 'admin/mustahik/index',
    ];

    echo view('admin/layout/wrapper', $data);
}



    /**
     * Menambahkan data mustahik
     */
    public function add()
{
    checklogin();

    // Ambil data ranting dari model
    $rantingModel = new \App\Models\Ranting_model(); // Pastikan Ranting_model sudah dibuat
    $ranting = $rantingModel->findAll(); // Ambil semua data ranting

    if ($this->request->getMethod() === 'post') {
        $rules = [
            'nama'       => 'required',
            'nik'        => 'required',
            'alamat'     => 'required',
            'nohp'       => 'required',
            'idranting'  => 'required',
            'foto'       => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]',
        ];

        if ($this->validate($rules)) {
            $fileFoto = $this->request->getFile('foto');
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(ROOTPATH . 'assets/upload/image/', $namaFoto);

            $this->mustahikModel->addmustahik([
                'nama'       => $this->request->getPost('nama'),
                'nik'        => $this->request->getPost('nik'),
                'alamat'     => $this->request->getPost('alamat'),
                'nohp'       => $this->request->getPost('nohp'),
                'idranting'  => $this->request->getPost('idranting'),
                'foto'       => $namaFoto,
            ]);

            $this->session->setFlashdata('sukses', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('admin/mustahik'));
        }
    }

    // Kirim data ranting ke view
    $data = [
        'title'      => 'Tambah Data Mustahik',
        'content'    => 'admin/mustahik/add',
        'ranting'    => $ranting, // Kirim data ranting ke view
        'validation' => $this->validator,
    ];

    echo view('admin/layout/wrapper', $data);
}



    /**
     * Mengedit data mustahik
     */
    public function edit($idmustahik)
    {
        checklogin();

        $mustahik = $this->mustahikModel->getmustahikById($idmustahik);

        if (!$mustahik) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data mustahik tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama'   => 'required',
                'nik'    => 'required',
                'alamat' => 'required',
                'nohp'   => 'required',
                'foto'   => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]',
            ];

            if ($this->validate($rules)) {
                $fileFoto = $this->request->getFile('foto');
                $namaFoto = $mustahik['foto'];

                if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                    if ($namaFoto && file_exists(ROOTPATH . 'assets/upload/image/' . $namaFoto)) {
                        unlink(ROOTPATH . 'assets/upload/image/' . $namaFoto);
                    }

                    $namaFoto = $fileFoto->getRandomName();
                    $fileFoto->move(ROOTPATH . 'assets/upload/image/', $namaFoto);
                }

                $this->mustahikModel->updatemustahik($idmustahik, [
                    'nama'       => $this->request->getPost('nama'),
                    'nik'        => $this->request->getPost('nik'),
                    'alamat'     => $this->request->getPost('alamat'),
                    'nohp'       => $this->request->getPost('nohp'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'foto'       => $namaFoto,
                ]);

                $this->session->setFlashdata('sukses', 'Data berhasil diperbarui');
                return redirect()->to(base_url('admin/mustahik'));
            }

            $this->session->setFlashdata('error', 'Terjadi kesalahan, periksa input Anda.');
        }

        $data = [
            'title'      => 'Edit Data Mustahik',
            'mustahik'   => $mustahik,
            'content'    => 'admin/mustahik/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    /**
     * Menghapus data mustahik
     */
    public function delete($idmustahik)
    {
        checklogin();

        $mustahik = $this->mustahikModel->getmustahikById($idmustahik);

        if (!$mustahik) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data mustahik tidak ditemukan.');
        }

        if ($mustahik['foto'] && file_exists(ROOTPATH . 'assets/upload/image/' . $mustahik['foto'])) {
            unlink(ROOTPATH . 'assets/upload/image/' . $mustahik['foto']);
        }

        $this->mustahikModel->deletemustahik($idmustahik);
        $this->session->setFlashdata('sukses', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/mustahik'));
    }
}
