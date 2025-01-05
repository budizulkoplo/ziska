<?php

namespace App\Controllers;

use App\Models\Program_model;

class Program extends BaseController
{
    // Menampilkan daftar program
    public function index()
    {
        helper('word');

        $m_program = new Program_model();
        $programs = $m_program->findAll(); // Mengambil semua data program

        // Data yang akan dikirim ke view
        $data = [
            'title'       => 'Program LAZIS',
            'description' => 'Daftar program yang tersedia',
            'keywords'    => 'program, lazis, daftar program',
            'programs'    => $programs, // Data program yang akan ditampilkan
            'content'     => 'program/index' // View untuk daftar program
        ];

        // Memuat view dengan data
        echo view('layout/wrapper', $data);
    }

    // Menampilkan detail program berdasarkan ID
    public function detail($idprogram)
    {
        $m_program = new Program_model();
        $program = $m_program->find($idprogram); // Mengambil data program berdasarkan ID

        if (!$program) {
            // Jika data program tidak ditemukan, tampilkan error
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data program tidak ditemukan.');
        }

        // Data yang akan dikirim ke view
        $data = [
            'title'       => 'Detail Program',
            'description' => 'Detail data program',
            'keywords'    => 'program, detail program',
            'program'     => $program, // Data program yang akan ditampilkan
            'content'     => 'program/detail' // View untuk detail program
        ];

        // Memuat view dengan data
        echo view('layout/wrapper', $data);
    }

    
}
