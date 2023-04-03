<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\BookingModel;
use App\Models\ExpensesModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;
use App\Models\PricelistModel;
use App\Models\ProductsModel;
use App\Models\QuantityModel;

class Expenses extends BaseController
{
    private $loggedInfo;
    private $expensesModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->expensesModel = new ExpensesModel();
    }

    public function view()
    {
        $expensesInfo = $this->expensesModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Expenses',
            'pageHeading' => 'Expenses',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'expensesInfo'  => $expensesInfo
        ];
        return view('common/top', $data)
            . view('expenses/view')
            . view('common/bottom');
    }

    public function add()
    {
        $data = [
            'pageTitle' => 'Crusher Administrator | Expenses',
            'pageHeading' => 'Expenses',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png'
        ];
        return view('common/top', $data)
            . view('expenses/add')
            . view('common/bottom');
    }

    public function addAction()
    {
        $validation = $this->validate([
            'expen_type' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Expen Type is required.'
                ],
            ],
            'reason' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'reason is required.'
                ],
            ],
            'receipt_no' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Number is required.'
                ],
            ],
            'amount' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'amount is required.'
                ],
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $expens = [
                'login_id' => $this->loggedInfo['login_id'],
                'expen_type' => $this->request->getVar("expen_type"),
                'reason' => $this->request->getVar("reason"),
                'receipt_no' => $this->request->getVar("receipt_no"),
                'amount' => $this->request->getVar("amount"),
                'payment_date' => date("Y-m-d H:i:s")
            ];
            $query = $this->expensesModel->insert($expens);
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('expenses/' . Hash::path('view'))->with('success', 'Congratulation. Saved');
        }
    }
}
