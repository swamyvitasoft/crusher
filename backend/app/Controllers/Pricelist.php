<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\PricelistModel;
use App\Models\ProductsModel;
use App\Models\QuantityModel;

class Pricelist extends BaseController
{
    private $loggedInfo;
    private $productsModel;
    private $quantityModel;
    private $pricelistModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->productsModel = new ProductsModel();
        $this->quantityModel = new QuantityModel();
        $this->pricelistModel = new PricelistModel();
    }
    public function view($price_id = 0)
    {
        $productsInfo = $this->productsModel->findAll();
        $quantityInfo = $this->quantityModel->findAll();
        $pricelistInfo = $this->pricelistModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | PriceList',
            'pageHeading' => 'PriceList',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'pricelistInfo'  => $pricelistInfo,
            'productsInfo' => $productsInfo,
            'quantityInfo' => $quantityInfo,
            'price_id'  => $price_id
        ];
        return view('common/top', $data)
            . view('pricelist/view')
            . view('common/bottom');
    }
    public function addAction()
    {
        $validation = $this->validate([
            'product' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Product is required.'
                ],
            ],
            'quantity' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Quantity is required.'
                ],
            ],
            'price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Total Amount is required.'
                ],
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $pricelist = [
                'product' => $this->request->getPost("product"),
                'quantity' => $this->request->getPost("quantity"),
                'price' => $this->request->getPost("price"),
                'login_id' => $this->loggedInfo['login_id']
            ];
            $paymentsInfo = $this->pricelistModel->where(["product" => $this->request->getPost("product"),"quantity" => $this->request->getPost("quantity")])->findAll();
            if(!empty($paymentsInfo)){
                return  redirect()->back()->with('fail', 'Product and Quantity Already added')->withInput();
            }
            if ($this->request->getPost("price_id")) {
                $query = $this->pricelistModel->update($this->request->getPost("price_id"), $pricelist);
            } else {
                $query = $this->pricelistModel->insert($pricelist);
            }
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('pricelist/' . Hash::path('view') . '/0')->with('success', 'Congratulations! Record Efected');
        }
    }
    public function delete($price_id = 0)
    {
        $query = $this->pricelistModel->delete(['price_id' => $price_id]);
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Files.');
        } else {
            return  redirect()->back()->with('success', 'Congratulation! Record Deleted ');
        }
    }
}
