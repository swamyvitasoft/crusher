<?php

use App\Libraries\Hash;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="text-center">Driver Receipt</p>
                    <h3 class="text-center">Crusher Management</h3>
                </div>
                <div class="card-body">
                    <div class="float-start">
                        <h5>Load Number: CRUSHER<?= $booking[0]['load_id'] ?></h5>
                        <h5>Vehicle Number: <?= $booking[0]['vehicle_no'] ?></h5>
                        <h5>Driver Name: <?= $booking[0]['driver_name'] ?></h5>
                        <h5>Date: <?= $booking[0]['load_date'] ?></h5>
                    </div>
                    <div class="float-end">
                        <h6>Product: <?= $booking[0]['product'] ?> m</h6>
                        <h6>Quantity: <?= $booking[0]['quantity'] ?> cft</h6>
                        <h6>Note: <?= $payments[0]['note'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <p class="text-center">Cashier Receipt</p>
                        <h3 class="text-center">Crusher Management</h3>
                    </div>
                    <div class="card-body">
                        <div class="float-start">
                            <h5>Load Number: CRUSHER<?= $booking[0]['load_id'] ?></h5>
                            <h5>Vehicle Number: <?= $booking[0]['vehicle_no'] ?></h5>
                            <h5>Driver Name: <?= $booking[0]['driver_name'] ?></h5>
                            <h6>Product: <?= $booking[0]['product'] ?> m</h6>
                            <h6>Quantity: <?= $booking[0]['quantity'] ?> cft</h6>
                        </div>
                        <div class="float-end">
                            <h5>Date: <?= $booking[0]['load_date'] ?></h5>
                            <h6>Total Amount: <?= $payments[0]['total_amount'] ?></h6>
                            <h6>Paid: <?= $payments[0]['payment_today'] ?></h6>
                            <h6>Due: <?= $payments[0]['due_amount'] ?></h6>
                            <h6>Type of Payment: <?= $payments[0]['payment_type'] ?></h6>
                            <h6>Note: <?= $payments[0]['note'] ?></h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button onclick="window.print();window.location.href='<?= site_url() ?>booking/<?= Hash::path('add') ?>';" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>