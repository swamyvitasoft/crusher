<?php

use App\Libraries\Hash;
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h3>Crusher Management System</h3>
                <p style="margin:0">Karimnagar</p>
                <p style="margin:0">505001</p>
                <p style="margin:0">9876543211</p>
                <p style="margin:0">admin@gmail.com</p>
            </div>
            <div class="float-end">
                <h5>Load Number: CRUSHER<?= $booking[0]['load_id'] ?></h5>
                <h6>Driver Name: <?= $booking[0]['driver_name'] ?></h6>
                <h6>Date: <?= $booking[0]['load_date'] ?></h6>
            </div>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <table class="table table-striped table-bordered w-100 d-md-table">
                    <tr>
                        <th>Receipt No</th>
                        <th>Payment Type</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Due</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    $payment_today = 0;
                    $due_amount = 0;
                    $total_amount = 0;
                    foreach ($payments as $key => $value) {
                    ?>
                        <tr>
                            <td>PR<?= $value['payment_id'] ?></td>
                            <td><?= $value['payment_type'] ?></td>
                            <td><?= $value['total_amount'] ?></td>
                            <td><?= $value['payment_today'] ?></td>
                            <td><?= $value['due_amount'] ?></td>
                            <td><?= $value['create_date'] ?></td>
                        </tr>
                    <?php
                        $payment_today = $payment_today + $value['payment_today'];
                        $due_amount = $value['due_amount'];
                        $total_amount = $value['total_amount'];
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-start">
                <h5>Vehicle Number: <?= $booking[0]['vehicle_no'] ?></h5>
                <h6>Product: <?= $booking[0]['product'] ?> m</h6>
                <h6>Quantity: <?= $booking[0]['quantity'] ?> cft</h6>
            </div>
            <div class="float-end">
                <h6>Total: <?= $total_amount ?></h6>
                <h6>Received: <?= $payment_today ?></h6>
                <h6>Balance: <?= $due_amount ?></h6>
            </div>
        </div>
    </div>
    <?php
    if ($print == "load") {
    ?>
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h3>Crusher Management System</h3>
                    <p style="margin:0">Karimnagar</p>
                    <p style="margin:0">505001</p>
                    <p style="margin:0">9876543211</p>
                    <p style="margin:0">admin@gmail.com</p>
                </div>
                <div class="float-end">
                    <h5>Load Number: CRUSHER<?= $booking[0]['load_id'] ?></h5>
                    <h6>Driver Name: <?= $booking[0]['driver_name'] ?></h6>
                    <h6>Date: <?= $booking[0]['load_date'] ?></h6>
                </div>
            </div>
            <div class="card-body">
                <?php
                $payment_today = 0;
                $due_amount = 0;
                $total_amount = 0;
                foreach ($payments as $key => $value) {
                    $payment_today = $payment_today + $value['payment_today'];
                    $due_amount = $value['due_amount'];
                    $total_amount = $value['total_amount'];
                }
                ?>
            </div>
            <div class="card-footer">
                <div class="float-start">
                    <h5>Vehicle Number: <?= $booking[0]['vehicle_no'] ?></h5>
                    <h6>Product: <?= $booking[0]['product'] ?> m</h6>
                    <h6>Quantity: <?= $booking[0]['quantity'] ?> cft</h6>
                </div>
                <div class="float-end">
                    <h6>Total: <?= $total_amount ?></h6>
                    <h6>Received: <?= $payment_today ?></h6>
                    <h6>Balance: <?= $due_amount ?></h6>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <button onclick="window.print();window.location.href='<?= site_url() ?>reports/<?= Hash::path('index') ?>/all';" class="btn btn-primary">Print</button>
    <a href="<?= site_url() ?>reports/<?= Hash::path('index') ?>/all"><button type="button" class="btn btn-warning">Cancel</button></a>
</div>