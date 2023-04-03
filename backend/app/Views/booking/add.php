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
                    <a href="<?= site_url() ?>booking/<?= Hash::path('view') ?>">List of Booking</a>
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
                            <form action="<?= site_url() ?>booking/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="email_id">Phone Number</label>
                                        <input type="text" name="email_id" class="form-control" id="email_id" placeholder="Phone Number" value="<?= set_value('email_id') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'email_id') : '' ?></small>
                                    </div>
                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                        <label for="driver_name">Driver Name</label>
                                        <input type="text" name="driver_name" class="form-control" id="driver_name" placeholder="Driver Name" value="<?= set_value('driver_name') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'driver_name') : '' ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="vehicle_no">Vehicle Number</label>
                                        <input type="text" name="vehicle_no" class="form-control" id="vehicle_no" placeholder="Vehicle Number" value="<?= set_value('vehicle_no') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'vehicle_no') : '' ?></small>
                                    </div>
                                    <div class="col-md-4 form-group mt-3 mt-md-0">
                                        <label for="product">Product</label>
                                        <select class="form-control" name="product" id="product">
                                            <option selected disabled>Product</option>
                                            <?php
                                            foreach ($productsInfo as $key => $row) {
                                            ?><option value="<?= $row['product'] ?>"><?= $row['product'] ?> m</option><?php
                                                                                                                    }
                                                                                                                        ?>
                                        </select>
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'product') : '' ?></small>
                                    </div>
                                    <div class="col-md-4 form-group mt-3 mt-md-0">
                                        <label for="quantity">Quantity</label>
                                        <select class="form-control" name="quantity" id="quantity">
                                            <option selected disabled>Quantity</option>
                                            <?php
                                            foreach ($quantityInfo as $key => $row) {
                                            ?><option value="<?= $row['quantity'] ?>"><?= $row['quantity'] ?> cft</option><?php
                                                                                                                        }
                                                                                                                            ?>
                                        </select>
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'quantity') : '' ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="payment_type">Payment Type</label>
                                        <select class="form-control" name="payment_type" id="payment_type">
                                            <option selected disabled>Payment Type</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'payment_type') : '' ?></small>
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <label for="price">Total Amount</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="Total Amount" value="<?= set_value('price') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price') : '' ?></small>
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <label for="price1">Paid Amount</label>
                                        <input type="text" name="price1" class="form-control" id="price1" placeholder="Paid Amount" value="<?= set_value('price1') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price1') : '' ?></small>
                                    </div>
                                    <div class="col-md-3 form-group mt-3 mt-md-0">
                                        <label for="price2">Due Amount</label>
                                        <input type="text" name="price2" class="form-control" id="price2" placeholder="Due Amount" value="<?= set_value('price2') ?>">
                                        <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price2') : '' ?></small>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="note" rows="7" placeholder="Note"><?= set_value('note') ?></textarea>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'note') : '' ?></small>
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
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#price').on('blur', function(e) {
            var quantity = $("#quantity").val();
            var product = $("#product").val();
            var pricelist = <?= json_encode($pricelistInfo) ?>;
            $.each(pricelist, function(index, row) {
                if (quantity == row['quantity'] && product == row['product']) {
                    $("#price").val(row['price']);
                }
            });
        });
        $('#price1').on('blur', function(e) {
            var price = $("#price").val();
            var price1 = $("#price1").val();
            var price2 = price - price1;
            $("#price2").val(price2);
        });
    });
</script>