<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Pembelian extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $log){
        parent::initController($request, $response, $log);
        $this->items=new \App\Models\MObat();
        $this->transaksi=new \App\Models\MPembelian();
    }

    public function index()
    {
        //
        $data['data']=false;
        $data['judul']='Pembelian';
        $data['controller']='pembelian';
        $data['header']=['Nama', 'Satuan', 'Jenis', 'Harga Jual', 'Harga Beli', 'Stok', 'Aksi'];
        $data['kolom']=['Nama', 'Jenis', 'Satuan', 'Harga_Jual', 'Harga_Beli', 'Stock'];
        $data['tabel']=$this->items->findAll();
        return view('web/pembelian', $data);
    }
}
