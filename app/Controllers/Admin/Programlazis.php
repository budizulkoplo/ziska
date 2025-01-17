<?php

namespace App\Controllers\Admin;

use App\Models\ProgramLazisModel;

class ProgramLazis extends BaseController
{
    // Menampilkan daftar program
    public function index()
{
    checklogin();  // Pastikan pengguna sudah login

    // Ambil idranting dari session
    $idranting = $this->session->get('idranting');

    // Inisialisasi model ProgramLazis
    $m_program = new ProgramLazisModel();

    // Jika idranting adalah 1 (All), ambil semua program
    if ($idranting == 1) {
        $program = $m_program->findAll();
    } else {
        // Jika idranting selain 1, ambil program berdasarkan idranting
        $program = $m_program->where('idranting', $idranting)->findAll();
    }

    // Ambil data ranting untuk dropdown atau referensi
    $rantingModel = new \App\Models\Ranting_model();
    $ranting = $rantingModel->findAll();

    // Data untuk view
    $data = [
        'title'   => 'Daftar Program Lazis',
        'program' => $program,  // Data program lazis
        'ranting' => $ranting,  // Data ranting untuk dropdown
        'content' => 'admin/programlazis/index',  // View yang digunakan
    ];

    echo view('admin/layout/wrapper', $data);
}


    // Menampilkan form untuk menambah program
    public function create()
{
    checklogin(); // Pastikan pengguna sudah login

    // Ambil data ranting dari model
    $rantingModel = new \App\Models\Ranting_model();
    $ranting = $rantingModel->findAll();

    // Ambil idranting yang dipilih dari request (misalnya dari parameter GET atau POST)
    $idranting = $this->session->get('idranting');

    // Ambil data muzaki berdasarkan idranting
    $muzakiModel = new \App\Models\Muzaki_model();
    if ($idranting == 1) {
        // Jika idranting adalah 1, ambil semua muzaki
        $muzaki = $muzakiModel->findAll();
    } else {
        // Jika idranting selain 1, ambil muzaki berdasarkan idranting
        $muzaki = $muzakiModel->where('idranting', $idranting)->findAll();
    }

    // Ambil data mustahik berdasarkan idranting
    $mustahikModel = new \App\Models\Mustahik_model();
    if ($idranting == 1) {
        // Jika idranting adalah 1, ambil semua mustahik
        $mustahik = $mustahikModel->findAll();
    } else {
        // Jika idranting selain 1, ambil mustahik berdasarkan idranting
        $mustahik = $mustahikModel->where('idranting', $idranting)->findAll();
    }

    // Kirim data ke view
    $data = [
        'title'   => 'Tambah Program Lazis',
        'ranting' => $ranting,
        'muzaki'  => $muzaki,  // Data muzaki
        'mustahik' => $mustahik,  // Data mustahik
        'content' => 'admin/programlazis/create',
    ];

    return view('admin/layout/wrapper', $data);
}

    // Menyimpan data program baru
    public function store()
{
    checklogin();  // Pastikan pengguna sudah login
    $m_program = new ProgramLazisModel();
    $programmuzakiModel = new \App\Models\ProgrammuzakiModel();
    $programmustahikModel = new \App\Models\ProgrammustahikModel();

    // Validasi input
    if (!$this->validate([
        'tglmulai'     => 'required|valid_date',
        'tglselesai'   => 'required|valid_date',
        'judulprogram' => 'required|string|max_length[255]',
        'deskripsiprogram' => 'required|string',
        'fotoprogram'  => 'uploaded[fotoprogram]|is_image[fotoprogram]|mime_in[fotoprogram,image/jpg,image/jpeg,image/png]|max_size[fotoprogram,2048]',
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
        'judulprogram' => $this->request->getPost('judulprogram'),
        'deskripsiprogram' => $this->request->getPost('deskripsiprogram'),
        'fotoprogram'  => $filename, // Nama file gambar yang telah diupload
        'targetdonasi' => $this->request->getPost('targetdonasi'),
        'terkumpul'    => $this->request->getPost('terkumpul'),
        'idranting'    => $this->request->getPost('idranting')
    ];

    $programId = $m_program->insert($data);  // Menyimpan data ke dalam tabel dan mendapatkan ID program

    // Menyimpan data muzaki yang dipilih
    $muzakiIds = $this->request->getPost('muzaki_ids');
    if (!empty($muzakiIds)) {
        $muzakiIdsArray = explode(',', $muzakiIds); // Ubah string ID menjadi array
        foreach ($muzakiIdsArray as $muzakiId) {
            $programmuzakiModel->save([
                'idprogram' => $programId,
                'idmuzaki'  => $muzakiId
            ]);
        }
    }

    // Menyimpan data mustahik yang dipilih
    $mustahikIds = $this->request->getPost('mustahik_ids');
    if (!empty($mustahikIds)) {
        $mustahikIdsArray = explode(',', $mustahikIds); // Ubah string ID menjadi array
        foreach ($mustahikIdsArray as $mustahikId) {
            $programmustahikModel->save([
                'idprogram' => $programId,
                'idmustahik' => $mustahikId
            ]);
        }
    }

    $this->session->setFlashdata('sukses', 'Program berhasil ditambahkan');

    return redirect()->to(base_url('admin/programlazis'));  // Kembali ke halaman daftar program
}

    // Menampilkan form untuk mengedit program
    public function edit($idprogram)
{
    checklogin(); // Pastikan pengguna sudah login

    // Ambil data program berdasarkan ID
    $programModel = new \App\Models\ProgramLazisModel();
    $program = $programModel->find($idprogram);

    if (!$program) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Program dengan ID ' . $idprogram . ' tidak ditemukan');
    }

    // Ambil data ranting dari model
    $rantingModel = new \App\Models\Ranting_model();
    $ranting = $rantingModel->findAll();

    // Ambil idranting yang terkait dengan program
    $idranting = $program['idranting'];

    // Ambil data muzaki berdasarkan idranting
    $muzakiModel = new \App\Models\Muzaki_model();
    if ($idranting == 1) {
        // Jika idranting adalah 1, ambil semua muzaki
        $muzaki = $muzakiModel->findAll();
    } else {
        // Jika idranting selain 1, ambil muzaki berdasarkan idranting
        $muzaki = $muzakiModel->where('idranting', $idranting)->findAll();
    }

    // Ambil data mustahik berdasarkan idranting
    $mustahikModel = new \App\Models\Mustahik_model();
    if ($idranting == 1) {
        // Jika idranting adalah 1, ambil semua mustahik
        $mustahik = $mustahikModel->findAll();
    } else {
        // Jika idranting selain 1, ambil mustahik berdasarkan idranting
        $mustahik = $mustahikModel->where('idranting', $idranting)->findAll();
    }

    // Ambil muzaki dan mustahik yang sudah terhubung dengan program
    $programMuzakiModel = new \App\Models\ProgramMuzakiModel();
    $programMustahikModel = new \App\Models\programMustahikModel();
    $selectedMuzaki = $programMuzakiModel->getMuzakiByProgram($idprogram);
    $selectedMustahik = $programMustahikModel->getMustahikByProgram($idprogram);

    // Kirim data ke view
    $data = [
        'title'           => 'Edit Program Lazis',
        'program'         => $program,           // Data program untuk diedit
        'ranting'         => $ranting,           // Data ranting
        'muzaki'          => $muzaki,            // Data muzaki
        'mustahik'        => $mustahik,          // Data mustahik
        'selectedMuzaki'  => $selectedMuzaki,    // Muzaki yang sudah terhubung dengan program
        'selectedMustahik'=> $selectedMustahik,  // Mustahik yang sudah terhubung dengan program
        'content'         => 'admin/programlazis/edit',
    ];

    return view('admin/layout/wrapper', $data);
}


    // Menyimpan perubahan data program
    public function update($idprogram)
{
    checklogin();  // Pastikan pengguna sudah login
    $m_program = new ProgramLazisModel();

    // Validasi input
    if (!$this->validate([
        'tglmulai'        => 'required|valid_date',
        'tglselesai'      => 'required|valid_date',
        'judulprogram'    => 'required|string|max_length[255]',
        'deskripsiprogram'=> 'required|string',
        'fotoprogram'     => 'permit_empty|uploaded[fotoprogram]|mime_in[fotoprogram,image/jpg,image/jpeg,image/png]|max_size[fotoprogram,2048]',
        'targetdonasi'    => 'required|numeric',
        'terkumpul'       => 'required|numeric',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Mulai transaksi
    $db = \Config\Database::connect();
    $db->transStart();

    // Menangani unggahan file gambar
    $fotoprogram = $this->request->getFile('fotoprogram');
    $fotoprogramName = null;

    if ($fotoprogram && $fotoprogram->isValid() && !$fotoprogram->hasMoved()) {
        $fotoprogramName = $fotoprogram->getRandomName();  // Generate nama unik untuk file
        try {
            $fotoprogram->move('assets/uploads/programlazis', $fotoprogramName);  // Simpan file
        } catch (\Exception $e) {
            $db->transRollback();  // Batalkan transaksi
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
        }
    }

    // Ambil data lama untuk menjaga fotoprogram lama jika tidak ada file baru yang diunggah
    $program = $m_program->find($idprogram);
    if (!$program) {
        $db->transRollback();
        $this->session->setFlashdata('error', 'Program tidak ditemukan');
        return redirect()->to(base_url('admin/programlazis'));
    }

    // Hapus file lama jika file baru diunggah
    if ($fotoprogramName && $program['fotoprogram'] && file_exists('assets/uploads/programlazis/' . $program['fotoprogram'])) {
        unlink('assets/uploads/programlazis/' . $program['fotoprogram']);
    }

    // Data yang akan diupdate
    $data = [
        'tglmulai'        => $this->request->getPost('tglmulai'),
        'tglselesai'      => $this->request->getPost('tglselesai'),
        'judulprogram'    => $this->request->getPost('judulprogram'),
        'deskripsiprogram'=> $this->request->getPost('deskripsiprogram'),
        'fotoprogram'     => $fotoprogramName ? $fotoprogramName : $program['fotoprogram'],  // Gunakan file baru jika ada
        'targetdonasi'    => $this->request->getPost('targetdonasi'),
        'terkumpul'       => $this->request->getPost('terkumpul'),
    ];

    // Update data ke database
    try {
        $m_program->update($idprogram, $data);
    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui program: ' . $e->getMessage());
    }

    // Selesaikan transaksi
    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui program. Silakan coba lagi.');
    }

    // Beri notifikasi sukses
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

    public function donate($idprogram)
{
    checklogin(); // Pastikan pengguna sudah login

    $m_program = new ProgramLazisModel();
    $program = $m_program->find($idprogram); // Ambil data program berdasarkan ID

    if (!$program) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Program dengan ID ' . $idprogram . ' tidak ditemukan');
    }

    $data = [
        'title'   => 'Donasi Program: ' . $program['judulprogram'],
        'program' => $program, // Data program untuk ditampilkan
        'content' => 'admin/programlazis/donate', // View untuk formulir donasi
    ];

    echo view('admin/layout/wrapper', $data);
}

// Simpan donasi
public function storeDonation()
{
    checklogin(); // Pastikan pengguna sudah login

    $transaksiModel = new \App\Models\TransaksiModel();
    $m_rekening = new \App\Models\RekeningModel();
    $m_kodetransaksi = new \App\Models\KodeTransaksiModel(); 

    // Validasi input
    if (!$this->validate([
        'idprogram'    => 'required|integer',
        'jumlah'       => 'required|numeric',
        'keterangan'   => 'required|string|max_length[255]',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Ambil data cashflow dan idrek dari tabel m_kodetransaksi
    $kodeTransaksi = $m_kodetransaksi->where('kodetransaksi', 'Donasi')->first(); // Ambil berdasarkan kodetransaksi 'Donasi'
    if (!$kodeTransaksi) {
        return redirect()->back()->with('error', 'Kode transaksi untuk Donasi tidak ditemukan.');
    }

    $cashflow = $kodeTransaksi['cashflow']; // Ambil nilai cashflow
    $idrek = $kodeTransaksi['idrekening']; // Ambil nilai idrek

    // Ambil data dari input form
    $data = [
        'tipetransaksi' => 'Donasi',
        'tgltransaksi'  => date('Y-m-d H:i:s'),
        'muzaki'        => session()->get('username'), // Username dari session
        'nominal'       => $this->request->getPost('jumlah'),
        'keterangan'    => $this->request->getPost('keterangan'),
        'program'       => $this->request->getPost('idprogram'), // ID program
        'donasi'        => $this->request->getPost('namaprogram'), // Nama program
        'idrek'         => $idrek, // ID Rekening dari KodeTransaksi
        'status'        => 'pending', // Default status transaksi
        'cashflow'      => $cashflow, // Cashflow berdasarkan kodetransaksi
        'buktibayar'    => null, // Diisi jika ada bukti bayar
    ];

    // Simpan data ke database
    $transaksiModel->save($data);

    // Redirect dengan pesan sukses
    return redirect()->to(base_url('admin/transaksi'))->with('sukses', 'Donasi berhasil ditambahkan, menunggu verifikasi.');
}


    
}

