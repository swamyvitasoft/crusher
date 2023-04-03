<?php

use App\Libraries\Hash;
use App\Models\PaymentsModel;
use App\Models\PricelistModel;

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
                    <a href="<?= site_url() ?>expenses/<?= Hash::path('add') ?>">Add Expenses</a>
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
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Type Expenses</th>
                                            <th>Receipt Number</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th class="none">Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($expensesInfo as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['expen_type'] ?> </td>
                                                <td><?= $row['receipt_no'] ?> </td>
                                                <td><?= $row['amount'] ?> </td>
                                                <td><?= $row['payment_date'] ?> </td>
                                                <td><?= $row['reason'] ?> </td>
                                                <!-- <td>
                                                    <button type="button" id="edit" class="btn btn-cyan btn-sm rounded text-white edit" value='{"id" :"<?= $row['expen_id'] ?>"}'> Edit </button>
                                                    <button type="button" class="btn btn-danger btn-sm rounded text-white delete" value='{"id" :"<?= $row['expen_id'] ?>"}'> Delete </button>
                                                </td> -->
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Type Expenses</th>
                                            <th>Receipt Number</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th class="none">Reason</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>