<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ExpensesModel;
use App\Models\LoginModel;
use App\Models\PaymentsModel;

class Dashboard extends BaseController
{
    private $loggedInfo;
    private $loginModel;
    private $bookingModel;
    private $paymentsModel;
    private $expensesModel;
    public function __construct()
    {
        $this->loggedInfo = session()->get('LoggedData');
        $this->loginModel = new LoginModel();
        $this->bookingModel = new BookingModel();
        $this->paymentsModel = new PaymentsModel();
        $this->expensesModel = new ExpensesModel();
    }

    public function index()
    {
        $today_loads = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m-%d')", date('Y-m-d'))->select('count(load_id) as today_loads')->first();
        $today_income = $this->paymentsModel->where("DATE_FORMAT(create_date,'%Y-%m-%d')", date('Y-m-d'))->select('sum(payment_today) as today_income')->first();
        $today_expenses = $this->expensesModel->where("DATE_FORMAT(payment_date,'%Y-%m-%d')", date('Y-m-d'))->select('sum(amount) as today_expenses')->first();
        $pending1 = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m-%d')", date('Y-m-d'))->findAll();
        $today_pending = 0;
        if (!empty($pending1)) {
            foreach ($pending1 as $row) {
                $paymentsInfo = $this->paymentsModel->where('load_id', $row['load_id'])->orderBy('payment_id', 'DESC')->get()->getResult();
                $due_amount = $paymentsInfo[0]['due_amount'];
                $today_pending = $today_pending + $due_amount;
            }
        }
        $today = array(
            'today_loads' => $today_loads['today_loads'] > 0 ? $today_loads['today_loads'] : 0,
            'today_income' => $today_income['today_income'] > 0 ? $today_income['today_income'] : 0,
            'today_expenses' => $today_expenses['today_expenses'] > 0 ? $today_expenses['today_expenses'] : 0,
            'today_pending' => $today_pending > 0 ? $today_pending : 0
        );
        $cm_loads = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m')", date('Y-m'))->select('count(load_id) as cm_loads')->first();
        $cm_income = $this->paymentsModel->where("DATE_FORMAT(create_date,'%Y-%m')", date('Y-m'))->select('sum(payment_today) as cm_income')->first();
        $cm_expenses = $this->expensesModel->where("DATE_FORMAT(payment_date,'%Y-%m')", date('Y-m'))->select('sum(amount) as cm_expenses')->first();
        $pending2 = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y-%m')", date('Y-m'))->findAll();
        $cm_pending = 0;
        if (!empty($pending2)) {
            foreach ($pending2 as $row) {
                $paymentsInfo = $this->paymentsModel->where('load_id', $row['load_id'])->orderBy('payment_id', 'DESC')->findAll();
                $due_amount = $paymentsInfo[0]['due_amount'];
                $cm_pending = $cm_pending + $due_amount;
            }
        }
        $cm = array(
            'cm_loads' => $cm_loads['cm_loads'] > 0 ? $cm_loads['cm_loads'] : 0,
            'cm_income' => $cm_income['cm_income'] > 0 ? $cm_income['cm_income'] : 0,
            'cm_expenses' => $cm_expenses['cm_expenses'] > 0 ? $cm_expenses['cm_expenses'] : 0,
            'cm_pending' => $cm_pending > 0 ? $cm_pending : 0
        );
        $cy_loads = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y')", date('Y'))->select('count(load_id) as cy_loads')->first();
        $cy_income = $this->paymentsModel->where("DATE_FORMAT(create_date,'%Y')", date('Y'))->select('sum(payment_today) as cy_income')->first();
        $cy_expenses = $this->expensesModel->where("DATE_FORMAT(payment_date,'%Y')", date('Y'))->select('sum(amount) as cy_expenses')->first();
        $pending3 = $this->bookingModel->where("DATE_FORMAT(load_date,'%Y')", date('Y'))->findAll();
        $cy_pending = 0;
        if (!empty($pending3)) {
            foreach ($pending3 as $row) {
                $paymentsInfo = $this->paymentsModel->where('load_id', $row['load_id'])->orderBy('payment_id', 'DESC')->findAll();
                $due_amount = $paymentsInfo[0]['due_amount'];
                $cy_pending = $cy_pending + $due_amount;
            }
        }
        $cy = array(
            'cy_loads' => $cy_loads['cy_loads'] > 0 ? $cy_loads['cy_loads'] : 0,
            'cy_income' => $cy_income['cy_income'] > 0 ? $cy_income['cy_income'] : 0,
            'cy_expenses' => $cy_expenses['cy_expenses'] > 0 ? $cy_expenses['cy_expenses'] : 0,
            'cy_pending' => $cy_pending > 0 ? $cy_pending : 0
        );
        $customers = $this->loginModel->where("login_id <>", 2)->select('count(login_id) as customers')->first();

        $data = [
            'pageTitle' => 'Crusher Administrator | Dashboard',
            'pageHeading' => 'Dashboard',
            'loggedInfo' => $this->loggedInfo,
            'logo' => site_url() . 'assets/images/logo.png',
            'today' => $today,
            'cm' => $cm,
            'cy' => $cy,
            'customers'    => $customers['customers'] > 0 ? $customers['customers'] : '0',
        ];
        return view('common/top', $data)
            . view('dashboard/index')
            . view('common/bottom');
    }
}
