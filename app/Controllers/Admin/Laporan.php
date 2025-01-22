<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WakafModel;

class Laporan extends BaseController
{
    public function wakaf()
    {
        $m_wakaf = new \App\Models\WakafModel();

        // Ambil data laporan wakaf menggunakan metode baru
        $dataWakaf = $m_wakaf->getLaporanWakaf();

        // Kirim data ke view
        $data = [
            'title'      => 'Laporan Wakaf',  // Judul halaman
            'printstatus' => 'print',         // Menandakan bahwa tombol print harus ditampilkan
            'dataWakaf'  => $dataWakaf,
            'content'    => 'admin/laporan/wakaf',
        ];
        
        return view('admin/layout/wrapper', $data);
        

        return view('admin/layout/wrapper', $data);
    }

    public function program()
    {
        $m_transaksi = new \App\Models\TransaksiModel();
        
        // Ambil data laporan zakat dengan join untuk mendapatkan nama ranting
        $dataLaporan = $m_transaksi->query("
            SELECT
                t.judulprogram,
                pl.idranting,
                r.namaranting,
                SUM(t.nominal) AS total_nominal,
                COUNT(t.idtransaksi) AS total_transaksi,
                SUM(CASE WHEN t.tipetransaksi = 'Zakat' THEN t.nominal ELSE 0 END) AS total_zakat,
                SUM(CASE WHEN t.tipetransaksi = 'Tasaruf' THEN t.nominal ELSE 0 END) AS total_tasaruf
            FROM
                transaksi t
            JOIN programlazis pl ON pl.idprogram = t.program
            JOIN ranting r ON r.idranting = pl.idranting
            WHERE
                t.tipetransaksi = 'Zakat' OR t.tipetransaksi = 'Tasaruf'
            GROUP BY
                t.judulprogram, pl.idranting, r.namaranting
            ORDER BY
                t.judulprogram
        ")->getResultArray();

        // Kirim data ke view
        $data = [
            'title'         => 'Laporan Program',
            'printstatus' => 'print',    
            'dataLaporan'   => $dataLaporan,
            'content'       => 'admin/laporan/program',
        ];

        return view('admin/layout/wrapper', $data);
    }

}
