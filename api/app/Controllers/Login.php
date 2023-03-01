<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $loginModel = new LoginModel();
        $data['login'] = $loginModel->findAll();
        return $this->respond($data);
    }
}
