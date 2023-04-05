<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\BookingModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;
use App\Models\PricelistModel;
use App\Models\ProductsModel;
use App\Models\QuantityModel;

class Reports extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $bookingModel;
    private $paymentsModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->loginModel = new LoginModel();
        $this->bookingModel = new BookingModel();
        $this->paymentsModel = new PaymentsModel();
    }

    public function index($find = "all")
    {
        if ($find == "all") {
            $bookingInfo = $this->bookingModel->findAll();
        } else {
            $bookingInfo = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m-%d')", $find)->findAll();
            if(! $bookingInfo){
                $bookingInfo = $this->bookingModel->where("DATE_FORMAT(load_date,'%m')", $find)->findAll();
            }
        }
        $data = [
            'pageTitle' => 'Crusher Administrator | Reports',
            'pageHeading' => 'Reports',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'bookingInfo'  => $bookingInfo
        ];
        return view('common/top', $data)
            . view('reports/index')
            . view('common/bottom');
    }
}
