<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class Products extends BaseController
{
    private $loggedInfo;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
    }

    public function view()
    {
        $productsModel = new ProductsModel();
        $productsInfo = $productsModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Products',
            'pageHeading' => 'Products',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'productsInfo'  => $productsInfo
        ];
        return view('common/top', $data)
            . view('products/view')
            . view('common/bottom');
    }
}
