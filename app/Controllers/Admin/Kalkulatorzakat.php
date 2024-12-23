<?php

namespace App\Controllers\Admin;

class Kalkulatorzakat extends BaseController
{
    public function index()
    {
        checklogin();
        $data = [
            'title'   => 'Kalkulator Zakat',
            'content' => 'admin/kalkulatorzakat/index',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function templateZakat($type)
    {
        checklogin();
        $viewPath = "admin/kalkulatorzakat/{$type}";
        if (file_exists(APPPATH . "Views/{$viewPath}.php")) {
            return view($viewPath);
        }
        return '<p class="text-danger">Form zakat tidak ditemukan.</p>';
    }    

    
}
