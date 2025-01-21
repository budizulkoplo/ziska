<?php

namespace App\Controllers;

use App\Models\WakafModel;
use App\Models\FotowakafModel;

class Wakaf extends BaseController
{
    // Halaman Wakaf (Frontend)
    public function index()
{
    $m_wakaf = new WakafModel();
    $m_fotowakaf = new FotowakafModel();

    // Ambil data wakaf
    $wakaf = $m_wakaf->findAll(); // Mengambil semua data wakaf

    // Loop untuk menambahkan foto surat dan foto objek berdasarkan idobject
    foreach ($wakaf as &$item) {
        $idobject = $item['idobject'];
    
        // Ambil satu foto objek untuk ikon marker
        $fotoObjek = $m_fotowakaf->where(['idobject' => $idobject, 'jenis' => 'objek'])->first();
        $item['filefoto'] = $fotoObjek['filefoto'] ?? 'default.png'; // Gunakan default.png jika foto tidak ada
    }
    

    $data = [
        'title'       => 'Data Wakaf',
        'description' => 'Daftar data wakaf yang tersedia',
        'keywords'    => 'wakaf, data wakaf, daftar wakaf',
        'wakaf'       => $wakaf, // Data wakaf beserta relasi foto
        'content'     => 'wakaf/index' // View yang digunakan
    ];

    echo view('layout/wrapper', $data);
}

    public function detail($idwakaf)
{
    $m_wakaf = new WakafModel();
    $wakaf = $m_wakaf->find($idwakaf); // Ambil data wakaf berdasarkan ID

    if (!$wakaf) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data wakaf tidak ditemukan.');
    }

    $data = [
        'title'       => 'Detail Wakaf',
        'description' => 'Detail data wakaf',
        'keywords'    => 'wakaf, detail wakaf',
        'wakaf'       => $wakaf,
        'content'     => 'wakaf/detail'
    ];

    echo view('layout/wrapper', $data);
}

}
