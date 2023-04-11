<?php

use App\Libraries\Hash;
use App\Models\PaymentsModel;

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
                    <a href="<?= site_url() ?>booking/<?= Hash::path('add') ?>">New Booking</a>
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
                                            <th>Load Number</th>
                                            <th>Vehicle</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th class="none">History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($bookingInfo as $row) :
                                        ?>
                                            <tr>
                                                <td>CMS<?= $row['load_id'] ?> </td>
                                                <td><?= $row['vehicle_no'] ?> </td>
                                                <td><?= $row['product'] ?> m</td>
                                                <td><?= $row['quantity'] ?> cft</td>
                                                <td><?= $row['price'] ?> </td>
                                                <?php
                                                $paymentsModel = new PaymentsModel();
                                                $paymentsInfo = $paymentsModel->where('load_id', $row['load_id'])->get()->getResult();
                                                ?>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <th>Payment Type</th>
                                                            <th>Total</th>
                                                            <th>Payment</th>
                                                            <th>Due</th>
                                                            <th>Date</th>
                                                        </tr>
                                                        <?php
                                                        foreach ($paymentsInfo as $key => $value) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $value->payment_type ?></td>
                                                                <td><?= $value->total_amount ?></td>
                                                                <td><?= $value->payment_today ?></td>
                                                                <td><?= $value->due_amount ?></td>
                                                                <td><?= $value->create_date ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Load Number</th>
                                            <th>Vehicle</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th class="none">History</th>
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