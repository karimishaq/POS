<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Pelanggan extends BaseController
{
    protected $model=null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $log){
        parent::initController($request, $response, $log);
        $this->model=new \App\Models\MPelanggan();
    }

    public function index()
    {
        //
        $data['data']=true;
        $data['judul']='Pelanggan';
        $data['controller']='pelanggan';
        $data['kolom']=['Nama', 'JK', 'Alamat', 'No_HP'];
        $data['header']=['Nama', 'Jenis Kelamin', 'Alamat', 'No. HP', "Aksi"];
        $data['tabel']=$this->model->findAll();
        return view('web/pelanggan', $data);
    }

    public function hapus($id=null){
        $target=$this->model->find($id);
        if($target){
            $this->model->delete($id);
        };
        return redirect()->to(base_url('pelanggan'));
    }

    public function edit(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "JK" => $this->request->getPost("jk"),
            "Alamat" => $this->request->getPost("alamat"),
            "No_HP" => $this->request->getPost("no_hp"),
        ];
        $this->model->update($this->request->getPost("id"), $data);
        return redirect()->to(base_url('pelanggan'));
    }

    public function tambah(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "JK" => $this->request->getPost("jk"),
            "Alamat" => $this->request->getPost("alamat"),
            "No_HP" => $this->request->getPost("no_hp"),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('pelanggan'));
    }
}
