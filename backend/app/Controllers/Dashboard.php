<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Crusher Administrator | Dashboard',
            'logo' => site_url() . 'assets/images/logo.png'
        ];
        return view('dashboard/index', $data);
    }
}
