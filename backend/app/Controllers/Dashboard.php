<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $loggedInfo;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Crusher Administrator | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png'
        ];
        return view('common/top', $data)
            . view('dashboard/index')
            . view('common/bottom');
    }
}
