<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pembelian extends ResourceController
{
    protected $modelName = 'App\Models\MPembelian';
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
        return $this->respond([
            'statusCode' => 200,
            'message'    => 'OK',
            'data'       => $this->model->find($id)
        ], 200);
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
                    'Id_Transaksi'     => $json->id,
                    'Supplier'   => $json->Supplier,
                    'Operator'   => $json->Operator,
                    'Harga'   => $json->Harga,
                    'Keterangan'   => $json->Keterangan,
                    
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
        //
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