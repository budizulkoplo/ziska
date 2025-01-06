<?php

namespace App\Controllers;

class Kalkulatorzakat extends BaseController
{
    public function index()
    {
        // Data untuk ditampilkan di frontend
        $data = [
            'title'   => 'Kalkulator Zakat',
            'description' => 'Tunaikan Zakat Anda',
            'keywords'    => 'kalkulator zakat, lazis',
            'content' => 'kalkulatorzakat/index', // Path ke view frontend
        ];
        // Menampilkan layout frontend dengan view kalkulator zakat
        echo view('layout/wrapper', $data);
    }

    public function templateZakat($type)
    {
        // Cek apakah template yang diminta ada
        $viewPath = "kalkulatorzakat/{$type}";
        if (file_exists(APPPATH . "Views/{$viewPath}.php")) {
            return view($viewPath);
        }
        // Jika tidak ditemukan, tampilkan pesan error
        return '<p class="text-danger">Form zakat tidak ditemukan.</p>';
    }
}
