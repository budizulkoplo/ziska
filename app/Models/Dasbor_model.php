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
