<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DetailPenjualan extends ResourceController
{
    protected $modelName = 'App\Models\MDetailPenjualan';
    protected $format = 'json';

    /**
     * index function
     * @method : GET
     */
    public function index()
    {
        return $this->respond([
            'statusCode' => 200,
            'message'    => 'OK',
            'jdata' => [],
            'data'       => $this->model->orderBy('id', 'DESC')->findAll()
        ], 200);
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
                    'Operator' => $json->Operator,
                    'Pelanggan'   => $json->Pelanggan,
                    'Harga_Akhir' => $json->Harga_Akhir,
                    'Keterangan' => $json->Keterangan
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
        //model
        $post = $this->model;

        if ($this->request)
        {
            //get request from Vue Js
            if($this->request->getJSON()) {
            
                $json = $this->request->getJSON();
                
                $post->update($json->Id, [
                    'Nama'     => $json->Nama,
                    'Keterangan'   => $json->Keterangan
                ]);

            } else {

                //get request from PostMan and more
                $data = $this->request->getRawInput();
                $post->update($id, $data);

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
