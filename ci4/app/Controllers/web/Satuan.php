<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Satuan extends BaseController
{
    protected $model=null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $log){
        parent::initController($request, $response, $log);
        $this->model=new \App\Models\MSatuan();
    }

    public function index()
    {
        //    
        $data['data']=true;
        $data['judul']='Satuan';
        $data['controller']='satuan';
        $data['header']=['Nama', 'Keterangan', 'Aksi'];
        $data['kolom']=['Nama', 'Keterangan'];
        $data['tabel']=$this->model->findAll();
        return view('web/satuan', $data);
    }

    public function hapus($id=null){
        $target=$this->model->find($id);
        if($target){
            $this->model->delete($id);
        };
        return redirect()->to(base_url('satuan'));
    }

    

    public function edit(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Keterangan" => $this->request->getPost("keterangan"),
        ];
        $this->model->update($this->request->getPost("id"), $data);
        return redirect()->to(base_url('satuan'));
    }

    public function tambah(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Keterangan" => $this->request->getPost("keterangan"),
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('satuan'));
    }
}
