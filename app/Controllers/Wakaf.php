<?php

namespace App\Controllers;

use App\Models\WakafModel;

class Wakaf extends BaseController
{
    // Halaman Wakaf (Frontend)
    public function index()
    {
        $m_wakaf = new WakafModel();
        $wakaf = $m_wakaf->listing(); // Ambil data wakaf dari model

        $data = [
            'title'       => 'Data Wakaf',
            'description' => 'Daftar data wakaf yang tersedia',
            'keywords'    => 'wakaf, data wakaf, daftar wakaf',
            'wakaf'       => $wakaf, // Data wakaf yang akan dikirim ke view
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
