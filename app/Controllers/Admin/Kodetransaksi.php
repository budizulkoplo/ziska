<?php

namespace App\Controllers\Admin;

use App\Models\KodetransaksiModel;

class Kodetransaksi extends BaseController
{
    // Halaman utama
    public function index()
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();

        $kodetransaksi = $m_kodetransaksi->findAll(); // Ambil data kodetransaksi

        // Validasi form untuk tambah data
        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodetransaksi' => 'required',
            'cashflow' => 'required|in_list[Pemasukan,Pengeluaran]'
        ])) {
            // Simpan ke database
            $data = [
                'kodetransaksi' => $this->request->getPost('kodetransaksi'),
                'cashflow' => $this->request->getPost('cashflow'),
            ];

            $m_kodetransaksi->save($data);
            $this->session->setFlashdata('sukses', 'Kodetransaksi baru berhasil ditambahkan.');

            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        $data = [
            'title'        => 'Manajemen Kodetransaksi',
            'kodetransaksi' => $kodetransaksi,
            'content'      => 'admin/kodetransaksi/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Edit kodetransaksi
    public function edit($idkodetransaksi)
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();

        $kodetransaksi = $m_kodetransaksi->find($idkodetransaksi);

        if (!$kodetransaksi) {
            $this->session->setFlashdata('error', 'Data kodetransaksi tidak ditemukan.');
            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        // Validasi form untuk update data
        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodetransaksi' => 'required',
            'cashflow' => 'required|in_list[Pemasukan,Pengeluaran]'
        ])) {
            $data = [
                'kodetransaksi' => $this->request->getPost('kodetransaksi'),
                'cashflow' => $this->request->getPost('cashflow'),
            ];

            $m_kodetransaksi->update($idkodetransaksi, $data);
            $this->session->setFlashdata('sukses', 'Data kodetransaksi berhasil diperbarui.');

            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        $data = [
            'title'          => 'Edit Kodetransaksi',
            'kodetransaksi'  => $kodetransaksi,
            'content'        => 'admin/kodetransaksi/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Hapus kodetransaksi
    public function delete($idkodetransaksi)
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();
        $kodetransaksi   = $m_kodetransaksi->find($idkodetransaksi);

        if (!$kodetransaksi) {
            $this->session->setFlashdata('error', 'Data kodetransaksi tidak ditemukan.');
            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        $m_kodetransaksi->delete($idkodetransaksi);
        $this->session->setFlashdata('sukses', 'Data kodetransaksi berhasil dihapus.');

        return redirect()->to(base_url('admin/kodetransaksi'));
    }

    public function update($idkodetransaksi)
{
    $m_kodetransaksi = new KodetransaksiModel();

    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'kodetransaksi' => 'required',
        'cashflow' => 'required|in_list[Pemasukan,Pengeluaran]',
    ], [
        'kodetransaksi' => [
            'required' => 'Kode Transaksi harus diisi.',
        ],
        'cashflow' => [
            'required' => 'Jenis Cash Flow harus dipilih.',
            'in_list' => 'Jenis Cash Flow tidak valid.',
        ],
    ]);

    if (!$this->validate($validation->getRules())) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Data yang akan di-update
    $data = [
        'kodetransaksi' => $this->request->getPost('kodetransaksi'),
        'cashflow' => $this->request->getPost('cashflow'),
    ];
    
    // Update data
    $m_kodetransaksi->update($idkodetransaksi, $data);
    
    // Redirect dengan pesan sukses
    return redirect()->to(base_url('admin/kodetransaksi'))->with('success', 'Data berhasil diupdate.');
}

}
