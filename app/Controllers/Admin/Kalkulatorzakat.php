<?php

namespace App\Controllers\Admin;

class Kalkulatorzakat extends BaseController
{
    // Halaman utama
    public function index()
    {
        checklogin();

        $data = [
            'title'   => 'Kalkulator Zakat',
            'content' => 'admin/kalkulatorzakat/index', // Halaman utama dengan menu pilihan jenis zakat
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Halaman Zakat Maal
    public function maal()
    {
        checklogin();

        $data = [
            'title'   => 'Zakat Harta (Maal)',
            'content' => 'admin/kalkulatorzakat/maal', // View untuk kalkulator Zakat Maal
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Halaman Zakat Pertanian
    public function pertanian()
    {
        checklogin();

        $data = [
            'title'   => 'Zakat Pertanian',
            'content' => 'admin/kalkulatorzakat/pertanian', // View untuk kalkulator Zakat Pertanian
        ];
        echo view('admin/layout/wrapper', $data);
    }
}
