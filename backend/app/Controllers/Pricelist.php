<?php

namespace App\Controllers;

use App\Models\PricelistModel;

class Pricelist extends BaseController
{
    private $loggedInfo;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
    }

    public function view()
    {
        $pricelistModel = new PricelistModel();
        $pricelistInfo = $pricelistModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | PriceList',
            'pageHeading' => 'PriceList',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'pricelistInfo'  => $pricelistInfo
        ];
        return view('common/top', $data)
            . view('pricelist/view')
            . view('common/bottom');
    }
}
