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

    $kodetransaksiModel = new \App\Models\KodetransaksiModel();
    $kodetransaksi = $kodetransaksiModel->where('cashflow', 'Pemasukan')->findAll();
    

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
        'kodetransaksi' => $kodetransaksi,
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
        'kodetransaksi' => 'required|string|max_length[255]',
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
        'idranting'    => $this->request->getPost('idranting'),
        'kodetransaksi'    => $this->request->getPost('kodetransaksi')
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

    $kodetransaksiModel = new \App\Models\KodetransaksiModel();
    $kodetransaksi = $kodetransaksiModel->where('cashflow', 'Pemasukan')->findAll();

    if (!$program) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Program dengan ID ' . $idprogram . ' tidak ditemukan');
    }

    // Ambil data ranting dari model
    $rantingModel = new \App\Models\Ranting_model();
    $ranting = $rantingModel->findAll();

    // Ambil idranting yang terkait dengan program
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

    // Ambil muzaki dan mustahik yang sudah terhubung dengan program
    $programMuzakiModel = new \App\Models\ProgramMuzakiModel();
    $programMustahikModel = new \App\Models\programMustahikModel();
    $selectedMuzaki = $programMuzakiModel->getMuzakiByProgram($idprogram);
    $selectedMustahik = $programMustahikModel->getMustahikByProgram($idprogram);

    // Kirim data ke view
    $data = [
        'title'           => 'Edit Program Lazis',
        'program'         => $program,           // Data program untuk diedit
        'ranting'         => $ranting,   
        'kodetransaksi'   => $kodetransaksi,          // Data ranting
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
    checklogin(); // Pastikan pengguna sudah login
    $m_program = new ProgramLazisModel();
    $m_programmuzaki = new \App\Models\ProgrammuzakiModel();
    $m_programmustahik = new \App\Models\ProgrammustahikModel();

    // Validasi input
    if (!$this->validate([
        'tglmulai'        => 'required|valid_date',
        'tglselesai'      => 'required|valid_date',
        'judulprogram'    => 'required|string|max_length[255]',
        'deskripsiprogram'=> 'required|string',
        'fotoprogram'     => 'permit_empty|uploaded[fotoprogram]|mime_in[fotoprogram,image/jpg,image/jpeg,image/png]|max_size[fotoprogram,2048]',
        'targetdonasi'    => 'required|numeric',
        'terkumpul'       => 'required|numeric',
        'muzaki_ids'      => 'permit_empty|string',
        'mustahik_ids'    => 'permit_empty|string',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Validasi tanggal selesai tidak boleh lebih kecil dari tanggal mulai
    $tglmulai = $this->request->getPost('tglmulai');
    $tglselesai = $this->request->getPost('tglselesai');
    if (strtotime($tglselesai) < strtotime($tglmulai)) {
        return redirect()->back()->withInput()->with('error', 'Tanggal selesai tidak boleh lebih kecil dari tanggal mulai');
    }

    // Mulai transaksi
    $db = \Config\Database::connect();
    $db->transStart();

    // Penanganan file gambar
    $fotoprogram = $this->request->getFile('fotoprogram');
    $fotoprogramName = null;

    if ($fotoprogram && $fotoprogram->isValid() && !$fotoprogram->hasMoved()) {
        $fotoprogramName = $fotoprogram->getRandomName();

        // Pastikan direktori ada
        if (!is_dir('assets/uploads/programlazis')) {
            mkdir('assets/uploads/programlazis', 0777, true);
        }

        try {
            $fotoprogram->move('assets/uploads/programlazis', $fotoprogramName);
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
        }
    }

    // Ambil data program lama
    $program = $m_program->find($idprogram);
    if (!$program) {
        $db->transRollback();
        return redirect()->to(base_url('admin/programlazis'))->with('error', 'Program tidak ditemukan');
    }

    // Hapus file lama jika ada file baru
    if ($fotoprogramName && $program['fotoprogram'] && file_exists('assets/uploads/programlazis/' . $program['fotoprogram'])) {
        unlink('assets/uploads/programlazis/' . $program['fotoprogram']);
    }

    // Data program yang akan diperbarui
    $data = [
        'tglmulai'        => $tglmulai,
        'tglselesai'      => $tglselesai,
        'judulprogram'    => $this->request->getPost('judulprogram'),
        'deskripsiprogram'=> $this->request->getPost('deskripsiprogram'),
        'fotoprogram'     => $fotoprogramName ? $fotoprogramName : $program['fotoprogram'],
        'targetdonasi'    => $this->request->getPost('targetdonasi'),
        'terkumpul'       => $this->request->getPost('terkumpul'),
        'kodetransaksi'    => $this->request->getPost('kodetransaksi')
    ];

    // Update data program
    $m_program->update($idprogram, $data);

    $muzaki_ids = array_filter(explode(',', $this->request->getPost('muzaki_ids') ?? ''));
$mustahik_ids = array_filter(explode(',', $this->request->getPost('mustahik_ids') ?? ''));

try {
    // Hapus relasi lama
    $m_programmuzaki->where('idprogram', $idprogram)->delete();
    $m_programmustahik->where('idprogram', $idprogram)->delete();

    // Tambahkan relasi baru untuk Muzaki
    foreach ($muzaki_ids as $muzaki_id) {
        $m_programmuzaki->insert(['idprogram' => $idprogram, 'idmuzaki' => $muzaki_id]);
    }

    // Tambahkan relasi baru untuk Mustahik
    foreach ($mustahik_ids as $mustahik_id) {
        $m_programmustahik->insert(['idprogram' => $idprogram, 'idmustahik' => $mustahik_id]);
    }

    $db->transComplete();

    if ($db->transStatus() === false) {
        throw new \Exception('Gagal menyimpan data');
    }

    return redirect()->to('/admin/programlazis')->with('success', 'Data berhasil diperbarui');
} catch (\Exception $e) {
    $db->transRollback();
    log_message('error', 'Error update relasi: ' . $e->getMessage());
    return redirect()->back()->withInput()->with('error', 'Gagal memperbarui relasi: ' . $e->getMessage());
}

    // Selesaikan transaksi
    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui program. Silakan coba lagi.');
    }

    // Beri notifikasi sukses
    return redirect()->to(base_url('admin/programlazis'))->with('sukses', 'Program berhasil diperbarui');
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

    // Mendapatkan id_user dari session
    $id_user = $this->session->get('id_user');

    // Memuat model ProgramLazis dan Programmuzaki
    $m_program = new ProgramLazisModel();
    $m_programmuzaki = new \App\Models\ProgrammuzakiModel();

    // Mendapatkan data program yang hanya ada di tabel programmuzaki dengan idmuzaki sesuai id_user
    $program_ids = $m_programmuzaki->select('idprogram')
                                    ->where('idmuzaki', $id_user) // Filter berdasarkan id_user
                                    ->findAll();

    // Mengambil idprogram yang ditemukan
    $idprograms = array_column($program_ids, 'idprogram');

    // Jika ada idprogram yang ditemukan, ambil data program terkait yang masih berjalan
    if (!empty($idprograms)) {
        $program = $m_program->whereIn('idprogram', $idprograms)
                             ->where('tglselesai >=', date('Y-m-d')) // Program yang tanggal selesai belum lewat
                             ->findAll();
    } else {
        // Jika tidak ada data program yang ditemukan
        $program = [];
    }

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
    $kodeTransaksi = $m_kodetransaksi->where('kodetransaksi', 'Program')->first(); // Ambil berdasarkan kodetransaksi 'Donasi'
    if (!$kodeTransaksi) {
        return redirect()->back()->with('error', 'Kode transaksi untuk Program tidak ditemukan.');
    }

    $cashflow = $kodeTransaksi['cashflow']; // Ambil nilai cashflow
    $idrek = $kodeTransaksi['idrekening']; // Ambil nilai idrek

    // Ambil data dari input form
    $data = [
        'tipetransaksi' => 'Program',
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

