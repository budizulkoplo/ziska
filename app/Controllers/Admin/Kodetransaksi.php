<?php

namespace App\Controllers\Admin;

use App\Models\KodetransaksiModel;
use App\Models\RekeningModel;

class Kodetransaksi extends BaseController
{
    // Halaman utama: Menampilkan semua data kodetransaksi
    public function index()
{
    checklogin();

    $m_kodetransaksi = new KodetransaksiModel();
    $m_rekening = new RekeningModel();

    // Mengambil semua data kodetransaksi dan rekening
    $kodetransaksi = $m_kodetransaksi->findAll();
    $rekening = $m_rekening->findAll();

    // Menambahkan data rekening ke setiap kodetransaksi berdasarkan idrekening
    foreach ($kodetransaksi as &$kode) {
        $rekeningData = array_filter($rekening, function ($rek) use ($kode) {
            return $rek['idrek'] == $kode['idrekening'];
        });

        if ($rekeningData) {
            $rekeningData = array_values($rekeningData)[0]; // Ambil data rekening pertama
            $kode['namarek'] = $rekeningData['namarek']; // Menambahkan nama rekening ke kodetransaksi
            $kode['norek'] = $rekeningData['norek']; // Menambahkan nomor rekening ke kodetransaksi
        }
    }

    // Validasi form untuk tambah data baru
    if ($this->request->getMethod() === 'post' && $this->validate([
        'kodetransaksi' => 'required',
        'cashflow'      => 'required|in_list[Pemasukan,Pengeluaran]',
        'idrekening'    => 'required|is_natural_no_zero|in_list[' . implode(',', array_column($rekening, 'idrek')) . ']', // Memastikan idrekening ada dalam daftar idrek
    ])) {
        // Data yang akan disimpan
        $data = [
            'kodetransaksi' => $this->request->getPost('kodetransaksi'),
            'cashflow'      => $this->request->getPost('cashflow'),
            'idrekening'    => $this->request->getPost('idrekening'),
        ];

        $m_kodetransaksi->save($data);
        $this->session->setFlashdata('sukses', 'Kodetransaksi baru berhasil ditambahkan.');

        return redirect()->to(base_url('admin/kodetransaksi'));
    }

    // Data untuk view
    $data = [
        'title'         => 'Manajemen Kodetransaksi',
        'kodetransaksi' => $kodetransaksi,
        'rekening'      => $rekening,
        'content'       => 'admin/kodetransaksi/index',
    ];
    echo view('admin/layout/wrapper', $data);
}


    // Edit kodetransaksi
    public function edit($idkodetransaksi)
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();
        $m_rekening = new RekeningModel();

        // Ambil data berdasarkan ID
        $kodetransaksi = $m_kodetransaksi->find($idkodetransaksi);
        $rekening = $m_rekening->findAll();

        if (!$kodetransaksi) {
            $this->session->setFlashdata('error', 'Data kodetransaksi tidak ditemukan.');
            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        // Validasi form untuk update data
        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodetransaksi' => 'required',
            'cashflow'      => 'required|in_list[Pemasukan,Pengeluaran]',
            'idrekening'    => 'required|numeric',
        ])) {
            // Data yang akan diperbarui
            $data = [
                'kodetransaksi' => $this->request->getPost('kodetransaksi'),
                'cashflow'      => $this->request->getPost('cashflow'),
                'idrekening'    => $this->request->getPost('idrekening'),
            ];

            $m_kodetransaksi->update($idkodetransaksi, $data);
            $this->session->setFlashdata('sukses', 'Data kodetransaksi berhasil diperbarui.');

            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        // Data untuk view
        $data = [
            'title'          => 'Edit Kodetransaksi',
            'kodetransaksi'  => $kodetransaksi,
            'rekening'       => $rekening,
            'content'        => 'admin/kodetransaksi/edit',
        ];
        echo view('admin/layout/wrapper', $data);
    }
    

    // Hapus kodetransaksi
    public function delete($idkodetransaksi)
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();

        $kodetransaksi = $m_kodetransaksi->find($idkodetransaksi);

        if (!$kodetransaksi) {
            $this->session->setFlashdata('error', 'Data kodetransaksi tidak ditemukan.');
            return redirect()->to(base_url('admin/kodetransaksi'));
        }

        $m_kodetransaksi->delete($idkodetransaksi);
        $this->session->setFlashdata('sukses', 'Data kodetransaksi berhasil dihapus.');

        return redirect()->to(base_url('admin/kodetransaksi'));
    }

    // Update kodetransaksi (fungsi khusus update)
    public function update($idkodetransaksi)
    {
        checklogin();

        $m_kodetransaksi = new KodetransaksiModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kodetransaksi' => 'required',
            'cashflow'      => 'required|in_list[Pemasukan,Pengeluaran]',
            'idrekening'    => 'required|numeric',
        ], [
            'kodetransaksi' => [
                'required' => 'Kode Transaksi harus diisi.',
            ],
            'cashflow' => [
                'required' => 'Jenis Cash Flow harus dipilih.',
                'in_list'  => 'Jenis Cash Flow tidak valid.',
            ],
            'idrekening' => [
                'required' => 'Rekening harus dipilih.',
                'numeric'  => 'Rekening yang dipilih tidak valid.',
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Data yang akan di-update
        $data = [
            'kodetransaksi' => $this->request->getPost('kodetransaksi'),
            'cashflow'      => $this->request->getPost('cashflow'),
            'idrekening'    => $this->request->getPost('idrekening'),
        ];
        
        // Update data
        $m_kodetransaksi->update($idkodetransaksi, $data);
        
        // Redirect dengan pesan sukses
        return redirect()->to(base_url('admin/kodetransaksi'))->with('success', 'Data berhasil diupdate.');
    }
}
