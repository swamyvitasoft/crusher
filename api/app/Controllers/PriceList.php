<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoginModel;
use App\Models\PricelistModel;
use App\Models\ProductsModel;
use App\Models\QuantityModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class PriceList extends ResourceController
{
    use ResponseTrait;
    private $loggedInfo;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function products()
    {
        $productsModel = new ProductsModel();
        $data = $productsModel->findAll();
        $response = [
            'status'   => 200,
            'error'    => false,
            'messages' => 'Products List.',
            'data'      => $data
        ];
        return $this->respondCreated($response);
    }
    public function quantity()
    {
        $quantityModel = new QuantityModel();
        $data = $quantityModel->findAll();
        $response = [
            'status'   => 200,
            'error'    => false,
            'messages' => 'Quanity List.',
            'data'      => $data
        ];
        return $this->respondCreated($response);
    }
    public function pricelist()
    {
        $pricelistModel = new PricelistModel();
        $data = $pricelistModel->findAll();
        $response = [
            'status'   => 200,
            'error'    => false,
            'messages' => 'Price List.',
            'data'      => $data
        ];
        return $this->respondCreated($response);
    }
}
