<?php

namespace App\Controllers;

use App\Models\Konfigurasi_model;
use App\Models\Berita_model;
use App\Models\ProgramlazisModel;

class Home extends BaseController
{
    // Homepage
    public function index()
    {
        $m_konfigurasi  = new Konfigurasi_model();
        $m_berita       = new Berita_model();
        $m_programlazis = new ProgramlazisModel(); // Model baru untuk slider

        // Ambil data dari model
        $konfigurasi  = $m_konfigurasi->listing();
        $slider       = $m_programlazis->slider(); // Ambil slider dari tabel programlazis
        $berita2      = $m_berita->beranda();

        // Data untuk dikirim ke view
        $data = [
            'title'         => 'Lazismu | Home',
            'description'   => $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
            'keywords'      => $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
            'slider'        => $slider, // Data slider baru
            'konfigurasi'   => $konfigurasi,
            'berita2'       => $berita2,
            'content'       => 'home/index',
        ];
        echo view('layout/wrapper', $data);
    }
}
