<?php

use App\Libraries\Hash;

$due_amount = $paymentsInfo[0]['total_amount'] - $paymentsInfo[0]['payment_today'];
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

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
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
                            <form action="<?= site_url() ?>reports/<?= Hash::path('paymentAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="remain">Remain Amount</label>
                                    <input type="text" name="remain" class="form-control" id="remain" placeholder="Remain Amount" value="<?= $due_amount ?>" readonly>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'remain') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price1">Paid Amount</label>
                                    <input type="text" name="price1" class="form-control" id="price1" placeholder="Paid Amount" value="<?= set_value('price1') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price1') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price2">Due Amount</label>
                                    <input type="text" name="price2" class="form-control" id="price2" placeholder="Due Amount" value="<?= set_value('price2') ?>" readonly>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price2') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="payment_type">Payment Type</label>
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <option selected disabled>Payment Type</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'payment_type') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="note" rows="7" placeholder="Note"><?= set_value('note') ?></textarea>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'note') : '' ?></small>
                                </div>
                                <input type="hidden" class="form-control" name="load_id" id="load_id" value="<?= $paymentsInfo[0]['load_id'] ?>">
                                <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="<?= $paymentsInfo[0]['customer_id'] ?>">
                                <input type="hidden" class="form-control" name="price" id="price" value="<?= $paymentsInfo[0]['total_amount'] ?>">
                                <div class="text-center"><button type="submit" class="btn btn-success">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h3><label class="text-primary">Total Sale:</label> <?= $paymentsInfo[0]['total_amount'] ?></h3>
                    <h3><label class="text-success">Paid: </label><?= $paymentsInfo[0]['payment_today'] ?></h3>
                    <h3><label class="text-danger">Due: </label><?= $due_amount ?></h3>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#price1').on('blur', function(e) {
            var remain = $("#remain").val();
            var price1 = $("#price1").val();
            var price2 = remain - price1;
            $("#price2").val(price2);
        });
    });
</script>