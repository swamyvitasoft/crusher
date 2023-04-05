<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\BookingModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;
use App\Models\PricelistModel;
use App\Models\ProductsModel;
use App\Models\QuantityModel;

class Booking extends BaseController
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

    public function view()
    {
        $bookingInfo = $this->bookingModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Booking',
            'pageHeading' => 'Booking',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'bookingInfo'  => $bookingInfo
        ];
        return view('common/top', $data)
            . view('booking/view')
            . view('common/bottom');
    }

    public function add()
    {
        $productsModel = new ProductsModel();
        $productsInfo = $productsModel->findAll();

        $quantityModel = new QuantityModel();
        $quantityInfo = $quantityModel->findAll();

        $pricelistModel = new PricelistModel();
        $pricelistInfo = $pricelistModel->findAll();

        $data = [
            'pageTitle' => 'Crusher Administrator | Booking',
            'pageHeading' => 'Booking',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'productsInfo' => $productsInfo,
            'quantityInfo' => $quantityInfo,
            'pricelistInfo' => $pricelistInfo
        ];
        return view('common/top', $data)
            . view('booking/add')
            . view('common/bottom');
    }

    public function addAction()
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
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $customer_info = $this->loginModel->where('email_id', $this->request->getPost("email_id"))->first();
            if (!empty($customer_info)) {
                $customer_id = $customer_info['login_id'];
            } else {
                $login = [
                    'role' => "Customer",
                    'name' => $this->request->getPost("driver_name"),
                    'email_id' => $this->request->getPost("email_id"),
                    'password' => Hash::make($this->request->getPost("email_id")),
                ];
                $this->loginModel->insert($login);
                $customer_id = $this->loginModel->getInsertID();
            }
            $booking = [
                'customer_id' => $customer_id,
                'driver_name' => $this->request->getPost("driver_name"),
                'product' => $this->request->getPost("product"),
                'quantity' => $this->request->getPost("quantity"),
                'vehicle_no' => $this->request->getPost("vehicle_no"),
                'price' => $this->request->getPost("price"),
                'login_id' => $this->loggedInfo['login_id'],
                'load_date' => date("Y-m-d H:i:s")
            ];
            $this->bookingModel->insert($booking);
            $load_id = $this->bookingModel->getInsertID();
            $payments = [
                'customer_id' => $customer_id,
                'load_id'   => $load_id,
                'payment_type' => $this->request->getPost("payment_type"),
                'note' => $this->request->getPost("note"),
                'total_amount' => $this->request->getPost("price"),
                'payment_today' => $this->request->getPost("price1"),
                'due_amount' => $this->request->getPost("price2"),
                'login_id' => $this->loggedInfo['login_id'],
            ];
            $query = $this->paymentsModel->insert($payments);
            $payment_id = $this->paymentsModel->getInsertID();
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('booking/' . Hash::path('print'))->with('input', array('load_id' => $load_id, 'payment_id' => $payment_id));
        }
    }

    public function print()
    {
        $input = session()->getFlashdata('input');
        if (empty($input)) {
            return  redirect()->to('booking/' . Hash::path('add'))->with('success', 'Book your Load First')->withInput();
        }
        $booking = $this->bookingModel->where('load_id', $input['load_id'])->findAll();
        $payments = $this->paymentsModel->where('payment_id', $input['payment_id'])->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Booking',
            'pageHeading' => 'Booking',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'booking' => $booking,
            'payments' => $payments
        ];
        return view('common/top', $data)
            . view('booking/print')
            . view('common/bottom');
    }
}
