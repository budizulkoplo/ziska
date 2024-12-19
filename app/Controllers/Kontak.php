<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Galeri_model;
use App\Models\Kontak_model;

class Kontak extends BaseController
{
	// Kontak
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_galeri		= new Galeri_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$slider 		= $m_galeri->slider();
		$m_kontak 		= new Kontak_model();
		$kontak 	= $m_kontak->listing();

		$data = [
			'title'			=> 'Kontak Kami',
			'description'	=> 'Kontak Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['tentang'],
			'keywords'		=> 'Kontak Kami ' . $konfigurasi['namaweb'] . ', ' . $konfigurasi['keywords'],
			'slider'		=> $slider,
			'konfigurasi'	=> $konfigurasi,
			'kontak'		=> $kontak,
			'content'		=> 'kontak/index'
		];
		echo view('layout/wrapper', $data);
	}

	public function input()
	{
		$m_kontak 		= new Kontak_model();
		$kontak 	= $m_kontak->listing();

		$data = [
			'nama'		=> $this->request->getPost('nama'),
			'email'		=> $this->request->getPost('email'),
			'testimoni'	=> $this->request->getPost('testimoni'),
			'tanggal_post'	=> date('Y-m-d H:i:s')
		];
		$m_kontak->tambah($data);
		// masuk database

		return redirect()->to(base_url('/kontak'));
	}
}
