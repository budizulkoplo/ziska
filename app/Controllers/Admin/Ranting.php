<?php

namespace App\Controllers\Admin;

use App\Models\Ranting_model;

class Ranting extends BaseController
{
    // Menampilkan semua data ranting
    public function index()
    {
        checklogin();

        $m_ranting = new Ranting_model();
        $ranting = $m_ranting->findAll();

        $data = [
            'title'   => 'Manajemen Ranting',
            'ranting' => $ranting,
            'content' => 'admin/ranting/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    // Tambah ranting baru
    public function add()
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'namaranting' => 'required',
        ])) {
            $m_ranting = new Ranting_model();

            $data = [
                'namaranting' => $this->request->getPost('namaranting'),
            ];

            $m_ranting->save($data);
            $this->session->setFlashdata('sukses', 'Data ranting baru berhasil ditambahkan.');

            return redirect()->to(base_url('admin/ranting'));
        }

        $data = [
            'title'   => 'Tambah Ranting',
            'content' => 'admin/ranting/add',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function tambah()
    {
        // Cek apakah user sudah login
        checklogin();

        // Inisialisasi model
        $m_ranting = new Ranting_model();

        // Validasi input
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'namaranting' => 'required|min_length[3]|max_length[100]',
            ];

            $errors = [
                'namaranting' => [
                    'required'    => 'Nama ranting wajib diisi.',
                    'min_length'  => 'Nama ranting harus memiliki minimal 3 karakter.',
                    'max_length'  => 'Nama ranting tidak boleh lebih dari 100 karakter.',
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                // Jika validasi gagal
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Ambil data dari input form
            $data = [
                'namaranting' => $this->request->getPost('namaranting'),
            ];

            // Simpan data ke database
            $m_ranting->save($data);

            // Flashdata untuk notifikasi sukses
            $this->session->setFlashdata('sukses', 'Ranting baru berhasil ditambahkan.');

            // Redirect kembali ke halaman daftar ranting
            return redirect()->to(base_url('admin/ranting'));
        }

        // Jika bukan request POST, redirect ke halaman ranting
        return redirect()->to(base_url('admin/ranting'));
    }

    // Edit data ranting
    public function edit($idranting)
    {
        checklogin();

        $m_ranting = new Ranting_model();
        $ranting = $m_ranting->find($idranting);

        if (!$ranting) {
            $this->session->setFlashdata('error', 'Data ranting tidak ditemukan.');
            return redirect()->to(base_url('admin/ranting'));
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'namaranting' => 'required',
        ])) {
            $data = [
                'namaranting' => $this->request->getPost('namaranting'),
            ];

            $m_ranting->update($idranting, $data);
            $this->session->setFlashdata('sukses', 'Data ranting berhasil diperbarui.');

            return redirect()->to(base_url('admin/ranting'));
        }

        $data = [
            'title'      => 'Edit Ranting',
            'ranting'    => $ranting,
            'content'    => 'admin/ranting/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function update($idranting)
{
    // Validasi Input
    $validation = \Config\Services::validation();

    $validation->setRules([
        'namaranting' => [
            'label' => 'Nama Ranting',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Nama Ranting harus diisi.',
                'max_length' => 'Nama Ranting tidak boleh lebih dari 255 karakter.',
            ],
        ],
    ]);

    if (!$this->validate($validation->getRules())) {
        // Jika validasi gagal, kembali ke form edit dengan pesan error
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    // Ambil data dari input
    $namaranting = $this->request->getPost('namaranting');

    // Update data di database
    $data = [
        'namaranting' => $namaranting,
    ];

    $model = new Ranting_model();
    $update = $model->update($idranting, $data);

    if ($update) {
        // Berhasil update
        return redirect()->to(base_url('admin/ranting'))
            ->with('success', 'Data Ranting berhasil diperbarui.');
    } else {
        // Gagal update
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan saat memperbarui data.');
    }
}

    // Hapus data ranting
    public function delete($idranting)
    {
        checklogin();

        $m_ranting = new Ranting_model();
        $ranting = $m_ranting->find($idranting);

        if (!$ranting) {
            $this->session->setFlashdata('error', 'Data ranting tidak ditemukan.');
            return redirect()->to(base_url('admin/ranting'));
        }

        $m_ranting->delete($idranting);
        $this->session->setFlashdata('sukses', 'Data ranting berhasil dihapus.');

        return redirect()->to(base_url('admin/ranting'));
    }
}
