<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\QuantityModel;

class Quantity extends BaseController
{
    private $loggedInfo;
    private $quantityModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->quantityModel = new QuantityModel();
    }

    public function view($id = 0)
    {
        $quantityInfo = $this->quantityModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Quantity',
            'pageHeading' => 'Quantity',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'quantityInfo'  => $quantityInfo,
            'id'    => $id
        ];
        return view('common/top', $data)
            . view('quantity/view')
            . view('common/bottom');
    }
    public function addAction()
    {
        $validation = $this->validate([
            'quantity' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Quantity is required.'
                ],
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $quantitylist = [
                'quantity' => $this->request->getPost("quantity"),
                'login_id' => $this->loggedInfo['login_id']
            ];
            if ($this->request->getPost("id")) {
                $query = $this->quantityModel->update($this->request->getPost("id"), $quantitylist);
            } else {
                $query = $this->quantityModel->insert($quantitylist);
            }
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('quantity/' . Hash::path('view') . '/0')->with('success', 'Congratulations! Record Efected');
        }
    }
    public function delete($id = 0)
    {
        $query = $this->quantityModel->delete(['id' => $id]);
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Files.');
        } else {
            return  redirect()->back()->with('success', 'Congratulation! Record Deleted ');
        }
    }
}
