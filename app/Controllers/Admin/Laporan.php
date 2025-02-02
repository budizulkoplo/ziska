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

    public function detailprogram()
    {
        $m_transaksi = new \App\Models\TransaksiModel();
        
        // Ambil data laporan zakat dengan join untuk mendapatkan nama ranting
        $dataLaporan = $m_transaksi->query("
            select * from transaksi a join programlazis p on a.program=p.idprogram
join programmuzaki pm on p.idprogram=pm.idprogram
join programmustahik pt on p.idprogram=pt.idprogram
where `status`='sukses'
        ")->getResultArray();

        // Kirim data ke view
        $data = [
            'title'         => 'Laporan Program',
            'printstatus' => 'print',    
            'dataLaporan'   => $dataLaporan,
            'content'       => 'admin/laporan/detailprogram',
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function transaksi()
    {
        $m_transaksi = new \App\Models\TransaksiModel();
        
        // Ambil data laporan transaksi dengan status 'sukses'
        $dataLaporanTransaksi = $m_transaksi->query("
            SELECT
                tgltransaksi,
                tipetransaksi,
                muzaki,
                mustahik,
                nominal,
                cashflow,
                judulprogram
            FROM
                transaksi
            WHERE
                status = 'sukses'
            ORDER BY
                tgltransaksi DESC
        ")->getResultArray();

        // Kirim data ke view
        $data = [
            'title'                 => 'Laporan Transaksi',
            'printstatus' => 'print', 
            'dataLaporanTransaksi'  => $dataLaporanTransaksi,
            'content'               => 'admin/laporan/transaksi',
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function zakat()
    {
        $m_transaksi = new \App\Models\TransaksiModel();

        // Ambil filter dari input
        $tahunDari = $this->request->getVar('tahun_dari') ?: date('Y') - 1;
        $tahunKe = $this->request->getVar('tahun_ke') ?: date('Y');
        $bulanDari = $this->request->getVar('bulan_dari') ?: 1;
        $bulanKe = $this->request->getVar('bulan_ke') ?: 12;

        // Grafik Tahunan
        $dataTahunan = $m_transaksi->query("
            SELECT
                YEAR(t.tgltransaksi) AS tahun,
                SUM(CASE WHEN t.cashflow = 'Pemasukan' THEN t.nominal ELSE 0 END) AS pemasukan,
                SUM(CASE WHEN t.cashflow = 'Pengeluaran' THEN t.nominal ELSE 0 END) AS pengeluaran
            FROM
                transaksi t
            WHERE
                t.status = 'sukses'
                AND YEAR(t.tgltransaksi) BETWEEN $tahunDari AND $tahunKe
            GROUP BY
                YEAR(t.tgltransaksi)
            ORDER BY
                tahun DESC
        ")->getResultArray();

        // Grafik Bulanan
        $dataBulanan = $m_transaksi->query("
            SELECT
                YEAR(t.tgltransaksi) AS tahun,
                MONTH(t.tgltransaksi) AS bulan,
                SUM(CASE WHEN t.cashflow = 'Pemasukan' THEN t.nominal ELSE 0 END) AS pemasukan,
                SUM(CASE WHEN t.cashflow = 'Pengeluaran' THEN t.nominal ELSE 0 END) AS pengeluaran
            FROM
                transaksi t
            WHERE
                t.status = 'sukses'
                AND YEAR(t.tgltransaksi) BETWEEN $tahunDari AND $tahunKe
                AND MONTH(t.tgltransaksi) BETWEEN $bulanDari AND $bulanKe
            GROUP BY
                YEAR(t.tgltransaksi), MONTH(t.tgltransaksi)
            ORDER BY
                tahun DESC, bulan DESC
        ")->getResultArray();

        // Grafik per Ranting
        $dataRanting = $m_transaksi->query("
            SELECT
                r.namaranting,
                SUM(CASE WHEN t.cashflow = 'Pemasukan' THEN t.nominal ELSE 0 END) AS pemasukan,
                SUM(CASE WHEN t.cashflow = 'Pengeluaran' THEN t.nominal ELSE 0 END) AS pengeluaran
            FROM
                transaksi t
            JOIN programlazis pl ON pl.idprogram = t.program
            JOIN ranting r ON r.idranting = pl.idranting
            WHERE
                 t.status = 'sukses'
            GROUP BY
                r.namaranting
        ")->getResultArray();
    
        // Grafik Pengeluaran (Tasaruf)
        $dataPengeluaran = $m_transaksi->query("
            SELECT
                SUM(CASE WHEN t.cashflow = 'Pengeluaran' THEN t.nominal ELSE 0 END) AS pengeluaran
            FROM
                transaksi t
            WHERE
                 t.status = 'sukses'
        ")->getRow();

        // Kirim data ke view
        $data = [
            'title'       => 'Laporan Zakat',
            'printstatus' => 'print', 
            'tahun_dari'  => $tahunDari,
            'tahun_ke'    => $tahunKe,
            'bulan_dari'  => $bulanDari,
            'bulan_ke'    => $bulanKe,
            'dataRanting'       => $dataRanting,
            'dataTahunan' => $dataTahunan,
            'dataBulanan' => $dataBulanan,
            'content'     => 'admin/laporan/zakat',
        ];

        return view('admin/layout/wrapper', $data);
    }


}
