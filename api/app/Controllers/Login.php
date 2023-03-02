<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoginModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    use ResponseTrait;
    private $loggedInfo;
    private $loginModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->loggedInfo = session()->get('LoggedData');
    }
    public function create()
    {
        $validation = $this->validate([
            'role' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Role is required.'
                ],
            ],
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Name is required.'
                ],
            ],
            'email_id' => [
                'rules'  => 'required|valid_email|is_unique[login.email_id]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Email not Valid',
                    'is_unique' => 'Email Already there'
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
            $password = '123456';
            $values = [
                'role' => $this->request->getVar("role"),
                'name' => $this->request->getVar("name"),
                'email_id' => $this->request->getVar("email_id"),
                'password' => Hash::make($password),
            ];
            $this->loginModel->insert($values);
            $response = [
                'status'   => 200,
                'error'    => false,
                'messages' => 'Congratulation. You are now successfully registered.',
                'data'      => []
            ];
        }
        return $this->respondCreated($response);
    }
    public function check()
    {
        $validation = $this->validate([
            'email_id' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Email not Valid'
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 5 characters in length.',
                    'max_length' => 'Password must not have characters more thant 20 in length.',
                ],
            ],
        ]);
        if (!$validation) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
            return $this->respond($response);
        } else {
            $email_id = $this->request->getVar('email_id');
            $password = $this->request->getVar('password');
            $logged_info = $this->loginModel->where('email_id', $email_id)->first();
            $check_password = Hash::check($password, $logged_info['password']);
            if (!$check_password) {
                return $this->failNotFound('No Data Found with Credentials ');
            } else {
                session()->set('LoggedData', $logged_info);
                $response = [
                    'status'   => 200,
                    'error'    => false,
                    'messages' => 'Congratulation. You are now successfully Logged IN.',
                    'data'      => $logged_info
                ];
                return $this->respondCreated($response);
            }
        }
    }
    public function index()
    {
        $loginModel = new LoginModel();
        $response = $loginModel->findAll();
        return $this->respondCreated($response);
    }
    public function login()
    {
        $response = [
            'status'   => 200,
            'error'    => false,
            'messages' => 'You are Already Logged In.',
            'data'      => $this->loggedInfo
        ];
        return $this->respondCreated($response);
    }
    public function auth()
    {
        $response = [
            'status'   => 500,
            'error'    => true,
            'messages' => 'You must be logged in first.',
            'data'      => []
        ];
        return $this->respondCreated($response);
    }
    public function logout()
    {
        if (session()->has('LoggedData')) {
            session()->remove('LoggedData');
            $response = [
                'status'   => 200,
                'error'    => false,
                'messages' => 'You are now successfully Logged Out.',
                'data'      => []
            ];
            return $this->respondCreated($response);
        }
    }
}
