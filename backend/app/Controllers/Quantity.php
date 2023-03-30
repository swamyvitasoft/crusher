<?php

namespace App\Controllers;

use App\Models\QuantityModel;

class Quantity extends BaseController
{
    private $loggedInfo;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
    }

    public function view()
    {
        $quantityModel = new QuantityModel();
        $quantityInfo = $quantityModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Quantity',
            'pageHeading' => 'Quantity',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'quantityInfo'  => $quantityInfo
        ];
        return view('common/top', $data)
            . view('quantity/view')
            . view('common/bottom');
    }
}
