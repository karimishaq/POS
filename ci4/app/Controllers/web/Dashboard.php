<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        //
        $data['data']=false;
        $data['judul']='Satuan';
        return view('web/dashboard', $data);
    }
}
