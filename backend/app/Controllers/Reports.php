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
            $find = date('Y-m-d');
        } else {
            $find1 = explode("-", $find);
            if (count($find1) == 1) {
                $bookingInfo = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y')", $find)->findAll();
                $find = $find . '-01';
            }
            if (count($find1) == 2) {
                $bookingInfo = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m')", $find)->findAll();
            }
            if (count($find1) == 3) {
                $bookingInfo = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m-%d')", $find)->findAll();
            }
        }
        $data = [
            'pageTitle' => 'Crusher Administrator | Reports',
            'pageHeading' => 'Reports',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'bookingInfo'  => $bookingInfo,
            'find'  => $find
        ];
        return view('common/top', $data)
            . view('reports/index')
            . view('common/bottom');
    }
    public function payment($load_id = 0)
    {
        $paymentsInfo = $this->paymentsModel->where("load_id", $load_id)->select('customer_id,load_id,total_amount,sum(payment_today) as payment_today,sum(due_amount) as due_amount')->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Payments',
            'pageHeading' => 'Payments',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'paymentsInfo'  => $paymentsInfo
        ];
        return view('common/top', $data)
            . view('reports/payment')
            . view('common/bottom');
    }
    public function paymentAction()
    {
        $validation = $this->validate([
            'remain' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Remain is required.'
                ],
            ],
            'payment_type' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Payment Type is required.'
                ],
            ],
            'note' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Amount Details is required.'
                ],
            ],
            'price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Total Amount is required.'
                ],
            ],
            'price1' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Paid Amount is required.'
                ],
            ],
            'price2' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Due Amount is required.'
                ],
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $payments = [
                'customer_id' => $this->request->getPost("customer_id"),
                'load_id'   => $this->request->getPost("load_id"),
                'payment_type' => $this->request->getPost("payment_type"),
                'note' => $this->request->getPost("note"),
                'total_amount' => $this->request->getPost("price"),
                'payment_today' => $this->request->getPost("price1"),
                'due_amount' => $this->request->getPost("price2"),
                'login_id' => $this->loggedInfo['login_id'],
            ];
            $query = $this->paymentsModel->insert($payments);
            if (!$query) {
                return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
            } else {
                return  redirect()->to('reports/' . Hash::path('index') . '/all')->with('success', 'Payment Done Success.');
            }
        }
    }
    public function customer($customer_id = 0)
    {
        $bookingInfo = $this->bookingModel->where("customer_id", $customer_id)->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Customer',
            'pageHeading' => 'Customer',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'bookingInfo'  => $bookingInfo
        ];
        return view('common/top', $data)
            . view('reports/customer')
            . view('common/bottom');
    }
}
