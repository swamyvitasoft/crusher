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
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <input type="date" class="form-control date" value="<?= date('Y-m-d', strtotime($find)) ?>" name="find" id="find">
                                </div>
                                <div class="col-md-2 form-group">
                                    <input type="month" class="form-control month" value="<?= date('Y-m', strtotime($find)) ?>" name="find" id="find">
                                </div>
                                <div class="col-md-2 form-group">
                                    <select class="form-control year" name="year" id="year">
                                        <?php
                                        for ($i = 2021; $i < 2031; $i++) {
                                            $find1 = date('Y', strtotime($find));
                                            if ($find1 == $i) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                            <option value="<?= $i ?>" <?= $selected ?>><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?= csrf_field(); ?>
                            <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config1" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>Driver</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th class="none">History</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sale = 0;
                                        $paid = 0;
                                        $due = 0;
                                        foreach ($bookingInfo as $row) :
                                            $sale = $sale + $row['price'];
                                        ?>
                                            <tr>
                                                <td><?= $row['vehicle_no'] ?> </td>
                                                <td><?= $row['driver_name'] ?> </td>
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
                                                        $payment_today = 0;
                                                        $due_amount = 0;
                                                        foreach ($paymentsInfo as $key => $value) {
                                                            $payment_today = $payment_today + $value->payment_today;
                                                            $due_amount = $value->due_amount;
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
                                                        $paid = $paid + $payment_today;
                                                        $due = $due + $due_amount;
                                                        ?>
                                                    </table>
                                                </td>
                                                <td><?= $payment_today ?></td>
                                                <td><?= $due_amount ?></td>
                                                <td><?= date("d-m-Y H:m:i", strtotime($row['load_date'])); ?> </td>
                                                <!-- <td>
                                                    <button type="button" id="edit" class="btn btn-cyan btn-sm rounded text-white edit" value='{"id" :"<?= $row['load_id'] ?>"}'> Edit </button>
                                                    <button type="button" class="btn btn-danger btn-sm rounded text-white delete" value='{"id" :"<?= $row['load_id'] ?>"}'> Delete </button>
                                                </td> -->
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>Driver</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th class="none">History</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <h3><label class="text-primary">Total Sale:</label> <?= $sale ?></h3>
                                <h3><label class="text-success">Paid: </label><?= $paid ?></h3>
                                <h3><label class="text-danger">Due: </label><?= $due ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#zero_config1').DataTable({
            'responsive': true,
            'searching': false
        });
        $(document).on("change", ".date", function(e) {
            var date = $(this).val();
            location.replace("<?= site_url() ?>reports/<?= Hash::path('index') ?>/" + date);
        });
        $(document).on("change", ".month", function(e) {
            var month = $(this).val();
            location.replace("<?= site_url() ?>reports/<?= Hash::path('index') ?>/" + month);
        });
        $(document).on("change", ".year", function(e) {
            var year = $(this).val();
            location.replace("<?= site_url() ?>reports/<?= Hash::path('index') ?>/" + year);
        });
    });
</script>