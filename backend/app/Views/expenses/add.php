<?php

use App\Libraries\Hash;
?>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?= view('common/header') ?>
    <?= view('common/aside') ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-8 d-flex no-block align-items-center">
                    <h4 class="page-title"><?= $pageHeading ?></h4>
                </div>
                <div class="col-4 d-flex no-block align-items-center">
                    <a href="<?= site_url() ?>expenses/<?= Hash::path('view') ?>">List of Expenses</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-head">
                            <?= csrf_field(); ?>
                            <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url() ?>expenses/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="expen_type">Head</label>
                                    <select class="form-control" name="expen_type" id="expen_type">
                                        <option selected disabled>Head Type</option>
                                        <option value="Crusher Unit">Crusher Unit</option>
                                        <option value="Vehicle Maintanance">Vehicle Maintanance</option>
                                        <option value="Salaries">Salaries</option>
                                        <option value="Electrical Bill">Electrical Bill</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'expen_type') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="reason">Purpose</label>
                                    <select class="form-control" name="reason" id="reason">
                                        <option selected disabled>Reason</option>
                                        <option value="Tea">Tea</option>
                                        <option value="Lunch">Lunch</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'reason') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="receipt_no">Payment To</label>
                                    <input type="text" name="receipt_no" class="form-control" id="receipt_no" placeholder="Vehicle/Employee/Meter Number" value="<?= set_value('receipt_no') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'receipt_no') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" value="<?= set_value('amount') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'amount') : '' ?></small>
                                </div>
                                <div class="text-center"><button type="submit">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>