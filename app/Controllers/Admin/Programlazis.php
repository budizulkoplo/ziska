<?php

namespace App\Controllers\Admin;

use App\Models\ProgramLazisModel;

class ProgramLazis extends BaseController
{
    // Menampilkan daftar program
    public function index()
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_program = new ProgramLazisModel();
        $program   = $m_program->findAll();  // Mengambil semua data program

        $data = [
            'title'   => 'Daftar Program Lazis',
            'program' => $program,  // Data program
            'content' => 'admin/programlazis/index',  // View yang digunakan
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menampilkan form untuk menambah program
    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $data = [
            'title'   => 'Tambah Program Lazis',
            'content' => 'admin/programlazis/create',  // View untuk form tambah program
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan data program baru
    public function store()
{
    checklogin();  // Pastikan pengguna sudah login
    $m_program = new ProgramLazisModel();

    // Validasi input
    if (!$this->validate([
        'tglmulai'     => 'required|valid_date',
        'tglselesai'   => 'required|valid_date',
        'judulprogram'        => 'required|string|max_length[255]',
        'deskripsiprogram'    => 'required|string',
        'fotoprogram'         => 'uploaded[fotoprogram]|is_image[fotoprogram]|mime_in[fotoprogram,image/jpg,image/jpeg,image/png]|max_size[fotoprogram,2048]',
        'targetdonasi' => 'required|numeric',
        'terkumpul'    => 'required|numeric',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Proses upload file
    $file = $this->request->getFile('fotoprogram');
    $filename = null; // Default jika tidak ada file diunggah

    if ($file->isValid() && !$file->hasMoved()) {
        // Generate nama file acak
        $filename = $file->getRandomName();
        // Simpan file ke folder uploads
        $file->move(ROOTPATH . 'assets/upload/programlazis/', $filename); 
    }

    // Menyimpan data program
    $data = [
        'tglmulai'     => $this->request->getPost('tglmulai'),
        'tglselesai'   => $this->request->getPost('tglselesai'),
        'judulprogram'        => $this->request->getPost('judulprogram'),
        'deskripsiprogram'    => $this->request->getPost('deskripsiprogram'),
        'fotoprogram'         => $filename, // Nama file gambar yang telah diupload
        'targetdonasi' => $this->request->getPost('targetdonasi'),
        'terkumpul'    => $this->request->getPost('terkumpul'),
    ];

    $m_program->save($data);  // Menyimpan data ke dalam tabel

    $this->session->setFlashdata('sukses', 'Program berhasil ditambahkan');

    return redirect()->to(base_url('admin/programlazis'));  // Kembali ke halaman daftar program
}


    // Menampilkan form untuk mengedit program
    public function edit($idprogram)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_program = new ProgramLazisModel();
        $program   = $m_program->find($idprogram);  // Mengambil data program berdasarkan ID

        if (!$program) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Program dengan ID ' . $idprogram . ' tidak ditemukan');
        }

        $data = [
            'title'   => 'Edit Program Lazis',
            'program' => $program,  // Data program untuk diubah
            'content' => 'admin/programlazis/edit',  // View untuk form edit program
        ];
        echo view('admin/layout/wrapper', $data);
    }

    // Menyimpan perubahan data program
    public function update($idprogram)
{
    checklogin();  // Pastikan pengguna sudah login
    $m_program = new ProgramLazisModel();

    // Validasi input
    if (!$this->validate([
        'tglmulai'     => 'required|valid_date',
        'tglselesai'   => 'required|valid_date',
        'judulprogram'        => 'required|string|max_length[255]',
        'deskripsiprogram'    => 'required|string',
        'fotoprogram'         => 'permit_empty|uploaded[fotoprogram]|mime_in[fotoprogram,image/jpg,image/jpeg,image/png]|max_size[fotoprogram,2048]',
        'targetdonasi' => 'required|numeric',
        'terkumpul'    => 'required|numeric',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Menangani unggahan file gambar
    $fotoprogram = $this->request->getFile('fotoprogram');
    $fotoprogramName = null;

    if ($fotoprogram && $fotoprogram->isValid() && !$fotoprogram->hasMoved()) {
        $fotoprogramName = $fotoprogram->getRandomName();  // Generate nama unik untuk file
        $fotoprogram->move('assets/uploads/programlazis', $fotoprogramName);  // Simpan file
    }

    // Ambil data lama untuk menjaga fotoprogram lama jika tidak ada file baru yang diunggah
    $program = $m_program->find($idprogram);
    if (!$program) {
        $this->session->setFlashdata('error', 'Program tidak ditemukan');
        return redirect()->to(base_url('admin/programlazis'));
    }

    // Data yang akan diupdate
    $data = [
        'tglmulai'     => $this->request->getPost('tglmulai'),
        'tglselesai'   => $this->request->getPost('tglselesai'),
        'judulprogram'        => $this->request->getPost('judulprogram'),
        'deskripsiprogram'    => $this->request->getPost('deskripsiprogram'),
        'fotoprogram'         => $fotoprogramName ? $fotoprogramName : $program['fotoprogram'],  // Jika fotoprogram baru diunggah, gunakan nama file baru
        'targetdonasi' => $this->request->getPost('targetdonasi'),
        'terkumpul'    => $this->request->getPost('terkumpul'),
    ];

    // Update data ke database
    $m_program->update($idprogram, $data);

    $this->session->setFlashdata('sukses', 'Program berhasil diperbarui');
    return redirect()->to(base_url('admin/programlazis'));
}


    // Menghapus program
    public function delete($idprogram)
    {
        checklogin();  // Pastikan pengguna sudah login
        $m_program = new ProgramLazisModel();
        $program   = $m_program->find($idprogram);  // Mengambil data program berdasarkan ID

        if (!$program) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Program dengan ID ' . $idprogram . ' tidak ditemukan');
        }

        $m_program->delete($idprogram);  // Menghapus data program berdasarkan ID

        $this->session->setFlashdata('sukses', 'Program berhasil dihapus');

        return redirect()->to(base_url('admin/programlazis'));  // Kembali ke halaman daftar program
    }

    public function viewprogram()
    {
        // Memastikan pengguna telah login
        checklogin();

        // Memuat model ProgramLazis
        $m_program = new ProgramLazisModel();

        // Mendapatkan data semua program
        $program = $m_program->findAll();

        // Mengirim data ke view
        $data = [
            'title'   => 'Program Lazis',
            'program' => $program, // Data program untuk ditampilkan
            'content' => 'admin/programlazis/viewprogram', // View yang akan ditampilkan
        ];

        // Menampilkan view
        echo view('admin/layout/wrapper', $data);
    }

    
}

