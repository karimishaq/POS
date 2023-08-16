<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Supplier extends BaseController
{
    protected $model=null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $log){
        parent::initController($request, $response, $log);
        $this->model=new \App\Models\MSupplier();
    }

    public function index()
    {
        //
        $data['data']=true;
        $data['judul']='Supplier';
        $data['controller']='supplier';
        $data['kolom']=['Nama', 'Kota', 'Alamat', 'No_HP'];
        $data['header']=['Nama', 'Kota', 'Alamat', 'No. HP', "Aksi"];
        $data['tabel']=$this->model->findAll();
        return view('web/supplier', $data);
    }

    public function hapus($id=null){
        $target=$this->model->find($id);
        if($target){
            $this->model->delete($id);
        };
        return redirect()->to(base_url('supplier'));
    }

    public function edit(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Kota" => $this->request->getPost("kota"),
            "Alamat" => $this->request->getPost("alamat"),
            "No_HP" => $this->request->getPost("no_hp"),
        ];
        $this->model->update($this->request->getPost("id"), $data);
        return redirect()->to(base_url('supplier'));
    }

    public function tambah(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Kota" => $this->request->getPost("kota"),
            "Alamat" => $this->request->getPost("alamat"),
            "No_HP" => $this->request->getPost("no_hp"),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('supplier'));
    }
}
