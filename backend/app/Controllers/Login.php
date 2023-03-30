<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\LoginModel;

class Login extends BaseController
{
    private $loginModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }
    public function login()
    {
        $data = [
            'pageTitle' => 'Crusher Administrator | Login',
            'logo' => site_url() . 'assets/images/logo.png'
        ];
        return view('login/index', $data);
    }
    public function create()
    {
        csrf_field();
        $name = "Super Admin";
        $email_id = "superadmin@gmail.com";
        $password = "123456";
        $values = [
            'role' => 'master',
            'name' => $name,
            'email_id' => $email_id,
            'password' => Hash::make($password),
        ];
        $query = $this->loginModel->insert($values);
        if (!$query) {
            echo "Something went wrong.";
            exit;
        } else {
            echo "Congratulation. You are now successfully registered.";
            exit;
        }
    }
}
