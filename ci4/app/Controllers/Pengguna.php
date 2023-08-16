<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pengguna extends ResourceController
{
    protected $modelName = 'App\Models\MPengguna';
    protected $format = 'json';

    /**
     * index function
     * @method : GET
     */
    public function index()
    {
        if ($this->request)
        {
            //get request from Vue Js
            if($this->request->getVar('total')) {
                $jdata=$this->request->getVar('total');
                $awal=$this->request->getVar('awal');
                $pencarian=$this->request->getVar('pencarian');
                $hasil=$this->model->like('Nama', $pencarian)->orderBy('id', 'DESC')->builder()->selectCount('Nama', 'jdata')->get();
                return $this->respond([
                    'statusCode' => 200,
                    'message'    => 'OK',
                    'jdata' => intval($hasil->getRow()->jdata),
                    'data'       => $this->model->like('Nama', $pencarian)->orderBy('id', 'DESC')->findAll($jdata, $awal)
                ], 200);
            }
        }else{
            return $this->respond([
                'statusCode' => 200,
                'message'    => 'OK',
                'data'       => []
            ], 200);
        }
    }

    /**
     * show function
     * @method : GET with params ID
     */
    public function show($id = null)
    {
        return $this->respond(
            $this->model->find($id), 200);
    }

    /**
     * create function
     * @method : POST
     */
    public function create()
    {
        if ($this->request)
        {
            //get request from Vue Js
            if($this->request->getJSON()) {

                $json = $this->request->getJSON();

                $post = $this->model->insert([
                    'Nama'     => $json->Nama,
                    'Username'   => $json->Username,
                    'JK'   => $json->JK,
                    'Alamat'   => $json->Alamat,
                    'Level'   => $json->Level,
                    'No_HP'   => $json->No_HP,
                    'Password' => '',
                    'Foto' => ''
                ]);
            }
            
            return $this->respond([
                'statusCode' => 201,
                'message'    => 'Data Berhasil Disimpan!', 
            ], 201);
        }
    }

    /**
     * update function
     * @method : PUT or PATCH
     */
    public function update($id = null)
    {

        if ($this->request)
        {
            //get request from Vue Js
            if($this->request->getJSON()) {      
                $json = $this->request->getJSON();
                
                $this->model->update($json->Id, [
                    'Nama'     => $json->Nama,
                    'Username'   => $json->Username,
                    'JK'   => $json->JK,
                    'Alamat'   => $json->Alamat,
                    'Level'   => $json->Level,
                    'No_HP'   => $json->No_HP,
                    'Password' => '',
                    'Foto' => ''
                ]);

            }

            return $this->respond([
                'statusCode' => 200,
                'message'    => 'Data Berhasil Diupdate!',
            ], 200);
        }
    }

    /**
     * edit function
     * @method : DELETE with params ID
     */
    public function delete($id = null)
    {
        $post = $this->model->find($id);

        if($post) {
            $this->model->delete($id);

            return $this->respond([
                'statusCode' => 200,
                'message'    => 'OK',
            ], 200);

        }
    }
}