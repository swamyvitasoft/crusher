<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoadsModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Load extends ResourceController
{
    use ResponseTrait;
    private $loggedInfo;
    private $loginModel;
    private $loadsModel;
    private $paymentsModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loadsModel = new LoadsModel();
        $this->paymentsModel = new PaymentsModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function save()
    {
        $validation = $this->validate([
            'email_id' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Phone is required.'
                ],
            ],
            'driver_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Driver Name is required.'
                ],
            ],
            'vehicle_no' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Vehicle Number is required.'
                ],
            ],
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
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {
            $customer_info = $this->loginModel->where('email_id', $this->request->getVar("email_id"))->first();
            if (!empty($customer_info)) {
                $customer_id = $customer_info['login_id'];
            } else {
                $login = [
                    'role' => "Customer",
                    'name' => $this->request->getVar("name"),
                    'email_id' => $this->request->getVar("email_id"),
                    'password' => Hash::make($this->request->getVar("email_id")),
                ];
                $this->loginModel->insert($login);
                $customer_id = $this->loginModel->getInsertID();
            }
            $loads = [
                'customer_id' => $customer_id,
                'driver_name' => $this->request->getVar("driver_name"),
                'product' => $this->request->getVar("product"),
                'quantity' => $this->request->getVar("quantity"),
                'vehicle_no' => $this->request->getVar("vehicle_no"),
                'price' => $this->request->getVar("price"),
                'login_id' => $this->loggedInfo['login_id'],
                'load_date' => date("Y-m-d H:i:s")
            ];
            $this->loadsModel->insert($loads);
            $load_id = $this->loadsModel->getInsertID();
            $payments = [
                'customer_id' => $customer_id,
                'load_id'   => $load_id,
                'payment_type' => $this->request->getVar("payment_type"),
                'note' => $this->request->getVar("note"),
                'total_amount' => $this->request->getVar("price"),
                'payment_today' => $this->request->getVar("price1"),
                'due_amount' => $this->request->getVar("price2"),
                'login_id' => $this->loggedInfo['login_id'],
            ];
            $this->paymentsModel->insert($payments);
            $response = [
                'status'   => 200,
                'error'    => false,
                'messages' => 'Congratulation. Loaded',
                'data'      => []
            ];
        }
        return $this->respondCreated($response);
    }
}
