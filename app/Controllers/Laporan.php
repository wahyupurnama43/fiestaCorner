<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {   
        $data['title'] = 'Laporan';
        return view('laporan/index', $data);
    }
}