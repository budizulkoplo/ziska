<?php

namespace App\Controllers\Admin;

use App\Models\User_model;
use App\Models\Muzaki_model;

class Akun extends BaseController
{
    public function index()
    {
        checklogin();

        $aksesLevel = $this->session->get('akses_level');
        $id_user = $this->session->get('id_user');
        $username = $this->session->get('username');

        if ($aksesLevel === 'muzaki') {
            $m_muzaki = new Muzaki_model();
            $user = $m_muzaki->select('id as id_user, nama, username, password, nik, alamat, nohp, keterangan, foto as gambar, created_at, updated_at')
                             ->where('username', $username)
                             ->first();

            if (!$user) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data muzaki tidak ditemukan.');
            }
        } else {
            $m_user = new User_model();
            $user = $m_user->detail($id_user);

            if (!$user) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data user tidak ditemukan.');
            }
        }

        // Validasi dan update
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'nama' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            $data = [
                'nama'       => $this->request->getPost('nama'),
                'nik'        => $this->request->getPost('nik'),
                'alamat'     => $this->request->getPost('alamat'),
                'nohp'       => $this->request->getPost('nohp'),
                'keterangan' => $this->request->getPost('keterangan'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Update password jika ada
            $password = $this->request->getPost('password');
            if (!empty($password) && strlen($password) >= 6 && strlen($password) <= 32) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Upload gambar baru
            if (!empty($_FILES['gambar']['name'])) {
                $avatar = $this->request->getFile('gambar');
                $namabaru = $avatar->getRandomName();
                $avatar->move(WRITEPATH . '../assets/upload/image/', $namabaru);

                \Config\Services::image()
                    ->withFile(WRITEPATH . '../assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save(WRITEPATH . '../assets/upload/image/thumbs/' . $namabaru);

                $data['gambar'] = $namabaru;

                // Hapus gambar lama
                $gambarLama = $user['gambar'];
                if (!empty($gambarLama) && file_exists(WRITEPATH . '../assets/upload/image/' . $gambarLama)) {
                    unlink(WRITEPATH . '../assets/upload/image/' . $gambarLama);
                    unlink(WRITEPATH . '../assets/upload/image/thumbs/' . $gambarLama);
                }
            }

            if ($aksesLevel === 'muzaki') {
                $m_muzaki->update($user['id_user'], $data);
            } else {
                $m_user->update($id_user, $data);
            }

            $this->session->setFlashdata('sukses', 'Data telah diperbarui.');
            return redirect()->to(base_url('admin/akun'));
        }

        $data = [
            'title'       => 'Update Profile: ' . $user['nama'],
            'user'        => $user,
            'aksesLevel'  => $aksesLevel, // Tambahkan ini
            'content'     => 'admin/akun/index',
        ];
        
        echo view('admin/layout/wrapper', $data);
    }
}
