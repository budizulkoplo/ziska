<?php

namespace App\Models;

use CodeIgniter\Model;

class Dasbor_model extends Model
{
    // berita
    public function berita()
    {
        $builder = $this->db->table('berita');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // user
    public function user()
    {
        $builder = $this->db->table('users');
        $query   = $builder->get();

        return $query->getNumRows();
    }
    // transaksi
    public function suksestransaksi()
    {
        $builder = $this->db->table('transaksi');
        $builder->selectSum('nominal');
        $builder->where('status', 'sukses');
        $query = $builder->get();

        return $query->getRow()->nominal; // Mengembalikan total nominal
    }

    public function listTahunTransaksi()
{
    $session = \Config\Services::session(); // Ambil instance session
    $id_muzaki = $session->get('id_user'); // Ambil ID muzaki dari session

    // Cari noanggota berdasarkan id_muzaki
    $builder = $this->db->table('muzaki'); // Sesuaikan nama tabel muzaki Anda
    $builder->select('noanggota');
    $builder->where('id', $id_muzaki); // Ambil data berdasarkan id_muzaki
    $query = $builder->get();
    $noanggota = $query->getRow()->noanggota ?? null; // Ambil noanggota atau null jika tidak ada

    if (!$noanggota) {
        // Jika noanggota tidak ditemukan, kembalikan 0
        return 0;
    }
    
    $session = \Config\Services::session(); // Ambil instance session
    $id_muzaki = $session->get('id_user'); // Ambil ID muzaki dari session

    $builder = $this->db->table('transaksi');  // Pastikan nama tabelnya benar
    $builder->select('YEAR(tgltransaksi) as tahun');
    $builder->where('muzaki', $noanggota); // Memfilter berdasarkan ID muzaki
    $builder->groupBy('YEAR(tgltransaksi)'); // Mengelompokkan berdasarkan tahun
    $builder->orderBy('tahun', 'DESC'); // Mengurutkan tahun secara menurun

    $query = $builder->get();

    return $query->getResult(); // Mengembalikan hasil berupa array tahun transaksi
}

public function sumTransaksiPerTahun($tahun)
{
    $session = \Config\Services::session(); // Ambil instance session
    $id_muzaki = $session->get('id_user'); // Ambil ID muzaki dari session

    // Cari noanggota berdasarkan id_muzaki
    $builder = $this->db->table('muzaki'); // Sesuaikan nama tabel muzaki Anda
    $builder->select('noanggota');
    $builder->where('id', $id_muzaki); // Ambil data berdasarkan id_muzaki
    $query = $builder->get();
    $noanggota = $query->getRow()->noanggota ?? null; // Ambil noanggota atau null jika tidak ada

    if (!$noanggota) {
        // Jika noanggota tidak ditemukan, kembalikan 0
        return 0;
    }

    $builder = $this->db->table('transaksi');  // Pastikan nama tabelnya benar
    $builder->selectSum('nominal');
    $builder->where('status', 'sukses');
    $builder->where('YEAR(tgltransaksi)', $tahun); // Memfilter berdasarkan tahun
    $builder->where('muzaki', $noanggota); // Memfilter berdasarkan ID muzaki
    
    $query = $builder->get();
    return $query->getRow()->nominal ?: 0; // Mengembalikan total nominal (atau 0 jika null)
}



        // transaksi
        public function pendingtransaksi()
        {
            $builder = $this->db->table('transaksi');
            $builder->selectSum('nominal');
            $builder->where('status !=', 'sukses'); 
            $query = $builder->get();
    
            return $query->getRow()->nominal; // Mengembalikan total nominal
        }

    // client
    public function muzaki()
    {
        $builder = $this->db->table('muzaki');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    public function wakaf()
    {
        $builder = $this->db->table('wakaf');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    public function programlazis()
    {
        $builder = $this->db->table('programlazis');
        $builder->where('tglselesai >=', date('Y-m-d')); // Kondisi tglselesai >= hari ini
        $builder->orderBy('tglmulai', 'ASC');            // Urutkan berdasarkan tglmulai ASC
        $query = $builder->get();
    
        return $query->getNumRows(); // Mengembalikan jumlah data
    }
    

    // galeri
    public function galeri()
    {
        $builder = $this->db->table('galeri');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // video
    public function video()
    {
        $builder = $this->db->table('video');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // download
    public function download()
    {
        $builder = $this->db->table('download');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // staff
    public function staff()
    {
        $builder = $this->db->table('staff');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori_download
    public function kategori_download()
    {
        $builder = $this->db->table('kategori_download');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori
    public function kategori()
    {
        $builder = $this->db->table('kategori');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    // kategori_staff
    public function kategori_staff()
    {
        $builder = $this->db->table('kategori_staff');
        $query   = $builder->get();

        return $query->getNumRows();
    }
}
