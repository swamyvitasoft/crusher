<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\ProductsModel;

class Products extends BaseController
{
    private $loggedInfo;
    private $productsModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->productsModel = new ProductsModel();
    }

    public function view($id = 0)
    {
        $productsInfo = $this->productsModel->findAll();
        $data = [
            'pageTitle' => 'Crusher Administrator | Products',
            'pageHeading' => 'Products',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'productsInfo'  => $productsInfo,
            'id'    => $id
        ];
        return view('common/top', $data)
            . view('products/view')
            . view('common/bottom');
    }
    public function addAction()
    {
        $validation = $this->validate([
            'product' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Product is required.'
                ],
            ]
        ]);
        if (!$validation) {
            return  redirect()->back()->with('validation', $this->validator)->withInput();
        } else {
            $productlist = [
                'product' => $this->request->getPost("product"),
                'login_id' => $this->loggedInfo['login_id']
            ];
            if ($this->request->getPost("id")) {
                $query = $this->productsModel->update($this->request->getPost("id"), $productlist);
            } else {
                $query = $this->productsModel->insert($productlist);
            }
        }
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Input Data.')->withInput();
        } else {
            return  redirect()->to('products/' . Hash::path('view') . '/0')->with('success', 'Congratulations! Record Efected');
        }
    }
    public function delete($id = 0)
    {
        $query = $this->productsModel->delete(['id' => $id]);
        if (!$query) {
            return  redirect()->back()->with('fail', 'Something went wrong Files.');
        } else {
            return  redirect()->back()->with('success', 'Congratulation! Record Deleted ');
        }
    }
}
