<?php

namespace App\Controllers;

use App\Models\ExpensesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Expenses extends ResourceController
{
    use ResponseTrait;
    private $loggedInfo;
    private $expensesModel;
    public function __construct()
    {
        $this->expensesModel = new ExpensesModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function save()
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
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {
            $expens = [
                'login_id' => $this->loggedInfo['login_id'],
                'expen_type' => $this->request->getVar("expen_type"),
                'reason' => $this->request->getVar("reason"),
                'receipt_no' => $this->request->getVar("receipt_no"),
                'amount' => $this->request->getVar("amount"),
                'payment_date' => date("Y-m-d H:i:s")
            ];
            $this->expensesModel->insert($expens);
            $response = [
                'status'   => 200,
                'error'    => false,
                'messages' => 'Congratulation. Saved',
                'data'      => []
            ];
        }
        return $this->respondCreated($response);
    }
}
