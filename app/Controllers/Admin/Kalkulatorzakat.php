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
            'js_file' => '',
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function templateZakat($type)
    {
        checklogin();
    
        $viewPath = "admin/kalkulatorzakat/{$type}";
        $scriptPath = "views/admin/kalkulatorzakat/js/{$type}.js";
    
        if (file_exists(APPPATH . "Views/{$viewPath}.php")) {
            $data = [
                'js_file' => $scriptPath,
            ];
            return view($viewPath, $data);
        }
    
        return '<p class="text-danger">Form zakat tidak ditemukan.</p>';
    }
    

    
}
