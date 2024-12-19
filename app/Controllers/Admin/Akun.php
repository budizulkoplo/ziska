<?php

namespace App\Controllers\Admin;

use App\Models\User_model;

class Akun extends BaseController
{
    public function index()
    {
        checklogin();
        $id_user = $this->session->get('id_user');
        $m_user  = new User_model();
        $user    = $m_user->detail($id_user);

        // Start validasi
        if ($this->request->getMethod() === 'post' && $this->validate(
            [
                'id_user' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            $data = [
                'nama'       => $this->request->getPost('nama'),
                'email'      => $this->request->getPost('email'),
                'username'   => $this->request->getPost('username'),
                'nik'        => $this->request->getPost('nik'),
                'alamat'     => $this->request->getPost('alamat'),
                'nohp'       => $this->request->getPost('nohp'),
                'keterangan' => $this->request->getPost('keterangan'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Handle password update
            $password = $this->request->getPost('password');
            if (!empty($password) && strlen($password) >= 6 && strlen($password) <= 32) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Handle image upload
            if (!empty($_FILES['gambar']['name'])) {
                $avatar   = $this->request->getFile('gambar');
                $namabaru = $avatar->getRandomName();
                $avatar->move(WRITEPATH . '../assets/upload/image/', $namabaru);

                // Create thumbnail
                \Config\Services::image()
                    ->withFile(WRITEPATH . '../assets/upload/image/' . $namabaru)
                    ->fit(100, 100, 'center')
                    ->save(WRITEPATH . '../assets/upload/image/thumbs/' . $namabaru);

                $data['gambar'] = $namabaru;

                // Hapus gambar lama jika ada
                if (!empty($user['gambar']) && file_exists(WRITEPATH . '../assets/upload/image/' . $user['gambar'])) {
                    unlink(WRITEPATH . '../assets/upload/image/' . $user['gambar']);
                    unlink(WRITEPATH . '../assets/upload/image/thumbs/' . $user['gambar']);
                }
            }

            $m_user->update($id_user, $data);

            $this->session->setFlashdata('sukses', 'Data telah diperbarui.');
            return redirect()->to(base_url('admin/akun'));
        }

        $data = [
            'title'   => 'Update Profile: ' . $user['nama'],
            'user'    => $user,
            'content' => 'admin/akun/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }
}
