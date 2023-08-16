<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Obat extends BaseController
{
    protected $model=null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $log){
        parent::initController($request, $response, $log);
        $this->model=new \App\Models\MObat();
    }

    public function index()
    {
        //
        $data['data']=true;
        $data['judul']='Obat';
        $data['controller']='obat';
        $data['header']=['Foto', 'Nama', 'Satuan', 'Jenis', 'Harga Jual', 'Harga Beli', 'Stok', 'Aksi'];
        $data['kolom']=['Foto', 'Nama', 'Jenis', 'Satuan', 'Harga_Jual', 'Harga_Beli', 'Stock'];
        $data['tabel']=$this->model->findAll();
        return view('web/obat', $data);
    }

    public function hapus($id=null){
        $target=$this->model->find($id);
        if($target){
            $this->model->delete($id);
        };
        return redirect()->to(base_url('obat'));
    }

    public function edit(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Jenis" => $this->request->getPost("jenis"),
            "Satuan" => $this->request->getPost("satuan"),
            "Harga_Jual" => $this->request->getPost("harga_jual"),
            "Harga_Beli" => $this->request->getPost("harga_beli")
        ];
        $this->model->update($this->request->getPost("id"), $data);
        return redirect()->to(base_url('obat'));
    }

    public function tambah(){
        $data=[
            "Nama" => $this->request->getPost("nama"),
            "Jenis" => $this->request->getPost("jenis"),
            "Satuan" => $this->request->getPost("satuan"),
            "Harga_Jual" => $this->request->getPost("harga_jual"),
            "Harga_Beli" => $this->request->getPost("harga_beli"),
            "Stock" => 0
        ];
        $this->model->insert($data);
        return redirect()->to(base_url('obat'));
    }

    public function upload(){
        $validation_rule=[
            'foto' => [
                'Image File',
                'rules' => [
                    'is_image[foto]',
                    'mime_in[foto,image/png]'
                ],
                'errors' => [
                    'is_image' => 'File anda bukan foto',
                    'mime_in' => 'invalid type'
                ] 
            ]
        ];
        $foto=$this->request->getFile("foto");
        if($this->validate($validation_rule)){
            $foto->move("Asset/tes");
        }else var_dump($this->validator->getErrors());
        return redirect()->to(base_url('obat'));
    }
}
