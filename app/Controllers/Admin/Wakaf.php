<?php

namespace App\Controllers\Admin;

use App\Models\WakafModel;
use App\Models\FotowakafModel;

class Wakaf extends BaseController
{
    // Menampilkan daftar wakaf
    public function index()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->findAll();  // Mengambil semua data wakaf

        $data = [
            'title'   => 'Daftar Wakaf',
            'wakaf'   => $wakaf,  // Data wakaf
            'content' => 'admin/wakaf/index',  // View yang digunakan
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menampilkan form untuk menambah wakaf
    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $data = [
            'title'   => 'Tambah Wakaf',
            'content' => 'admin/wakaf/create',  // View untuk form tambah wakaf
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan data wakaf baru
    public function store()
{
    checklogin();  // Pastikan pengguna sudah login
    $m_wakaf = new WakafModel();
    $m_fotowakaf = new FotowakafModel();

    // Validasi input
    if (!$this->validate([
        'idobject'     => 'required|string|max_length[255]',
        'nosertifikat' => 'required|string|max_length[255]',
        'alamat'       => 'required|string',
        'koordinat'    => 'required|string|max_length[255]',
        'pewakaf'      => 'required|string|max_length[255]',
        'keterangan'   => 'permit_empty|string',
        'status'       => 'required|string|max_length[50]',
        'surat'         => 'permit_empty|uploaded[surat]|is_image[surat]|max_size[surat,2048]',
        'objek'         => 'permit_empty|uploaded[objek]|is_image[objek]|max_size[objek,2048]',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Menyimpan data wakaf
    $data = [
        'idobject'     => $this->request->getPost('idobject'),
        'nosertifikat' => $this->request->getPost('nosertifikat'),
        'alamat'       => $this->request->getPost('alamat'),
        'koordinat'    => $this->request->getPost('koordinat'),
        'pewakaf'      => $this->request->getPost('pewakaf'),
        'keterangan'   => $this->request->getPost('keterangan'),
        'status'       => $this->request->getPost('status'),
    ];

    $idwakaf = $m_wakaf->insert($data);  // Insert data wakaf dan ambil ID-nya

    // Upload foto surat jika ada
    if ($suratFiles = $this->request->getFiles('surat')) {
        foreach ($suratFiles as $file) {
            if (is_object($file) && $file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();  // Membuat nama file acak
                $file->move(WRITEPATH . 'uploads/wakaf', $filename);

                // Menyimpan data foto surat ke database
                $fotoData = [
                    'idobject'   => $this->request->getPost('idobject'),
                    'namafoto'   => $file->getName(),
                    'filefoto'   => $filename,
                    'jenis'      => 'surat',
                ];
                $m_fotowakaf->insert($fotoData);
            }
        }
    }

    // Upload foto objek jika ada
    if ($objekFiles = $this->request->getFiles('objek')) {
        foreach ($objekFiles as $file) {
            if (is_object($file) && $file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads/wakaf', $filename);

                // Menyimpan data foto objek ke database
                $fotoData = [
                    'idobject'   => $this->request->getPost('idobject'),
                    'namafoto'   => $file->getName(),
                    'filefoto'   => $filename,
                    'jenis'      => 'objek',
                ];
                $m_fotowakaf->insert($fotoData);
            }
        }
    }

    $this->session->setFlashdata('sukses', 'Wakaf berhasil ditambahkan');
    return redirect()->to(base_url('admin/wakaf'));
}


    // Menangani proses upload foto
    private function uploadFoto($m_fotowakaf, $idwakaf)
    {
        $foto = $this->request->getFile('foto');
        $filename = $foto->getRandomName();  // Membuat nama file acak

        // Pindahkan file ke folder yang diinginkan
        if (!$foto->move(WRITEPATH . 'uploads/wakaf', $filename)) {
            throw new \RuntimeException('Gagal mengunggah foto');
        }

        // Menyimpan data foto
        $fotoData = [
            'idobject'   => $this->request->getPost('idobject'),
            'namafoto'   => $this->request->getPost('namafoto'),
            'filefoto'   => $filename,
            'jenis'      => $this->request->getPost('jenis'),  // Surat atau Objek
        ];

        // Menyimpan foto ke database
        $m_fotowakaf->insert($fotoData);
    }

    // Menampilkan form untuk mengedit wakaf
    public function edit($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->find($idwakaf);  // Mengambil data wakaf berdasarkan ID

        if (!$wakaf) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Wakaf dengan ID ' . $idwakaf . ' tidak ditemukan');
        }

        $data = [
            'title'   => 'Edit Wakaf',
            'wakaf'   => $wakaf,  // Data wakaf untuk diubah
            'content' => 'admin/wakaf/edit',  // View untuk form edit wakaf
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan perubahan data wakaf
    public function update($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $m_fotowakaf = new FotowakafModel();

        // Validasi input
        if (!$this->validate([
            'idobject'     => 'required|string|max_length[255]',
            'nosertifikat' => 'required|string|max_length[255]',
            'alamat'       => 'required|string',
            'koordinat'    => 'required|string|max_length[255]',
            'pewakaf'      => 'required|string|max_length[255]',
            'keterangan'   => 'permit_empty|string',
            'status'       => 'required|string|max_length[50]',
            'foto'         => 'permit_empty|uploaded[foto]|is_image[foto]|max_size[foto,2048]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'idobject'     => $this->request->getPost('idobject'),
            'nosertifikat' => $this->request->getPost('nosertifikat'),
            'alamat'       => $this->request->getPost('alamat'),
            'koordinat'    => $this->request->getPost('koordinat'),
            'pewakaf'      => $this->request->getPost('pewakaf'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'status'       => $this->request->getPost('status'),
        ];

        // Update data wakaf
        $m_wakaf->update($idwakaf, $data);

        // Upload foto baru jika ada
        if ($this->request->getFile('foto')->isValid()) {
            $this->uploadFoto($m_fotowakaf, $idwakaf);
        }

        $this->session->setFlashdata('sukses', 'Wakaf berhasil diperbarui');
        return redirect()->to(base_url('admin/wakaf'));
    }

    // Menghapus wakaf
    public function delete($idwakaf)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_wakaf = new WakafModel();
        $wakaf   = $m_wakaf->find($idwakaf);  // Mengambil data wakaf berdasarkan ID

        if (!$wakaf) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Wakaf dengan ID ' . $idwakaf . ' tidak ditemukan');
        }

        // Hapus foto terkait jika ada
        $this->deleteFotowakaf($wakaf['idobject']);

        // Hapus data wakaf
        $m_wakaf->delete($idwakaf);

        $this->session->setFlashdata('sukses', 'Wakaf berhasil dihapus');
        return redirect()->to(base_url('admin/wakaf'));
    }

    // Menghapus foto terkait wakaf
    private function deleteFotowakaf($idobject)
    {
        $m_fotowakaf = new FotowakafModel();
        $fotowakaf = $m_fotowakaf->where('idobject', $idobject)->findAll();

        foreach ($fotowakaf as $foto) {
            unlink(WRITEPATH . 'uploads/wakaf/' . $foto['filefoto']);
            $m_fotowakaf->delete($foto['idfoto']);
        }
    }
}



