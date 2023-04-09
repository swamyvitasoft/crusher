<?php

use App\Libraries\Hash;
?>
<div class="card">
    <div class="card-body">
        <form action="<?= site_url() ?>pricelist/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="product">Product</label>
                <select class="form-control" name="product" id="product">
                    <option selected disabled>Product</option>
                    <?php
                    foreach ($productsInfo as $key => $row) {
                    ?>
                        <option value="<?= $row['product'] ?>"><?= $row['product'] ?> m</option>
                    <?php
                    }
                    ?>
                </select>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'product') : '' ?></small>
            </div>
            <div class="form-group mt-3">
                <label for="quantity">Quantity</label>
                <select class="form-control" name="quantity" id="quantity">
                    <option selected disabled>Quantity</option>
                    <?php
                    foreach ($quantityInfo as $key => $row) {
                    ?>
                        <option value="<?= $row['quantity'] ?>"><?= $row['quantity'] ?> cft</option>
                    <?php
                    }
                    ?>
                </select>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'quantity') : '' ?></small>
            </div>
            <div class="form-group mt-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?= set_value('price') ?>"></textarea>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price') : '' ?></small>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success">Save</button></div>
        </form>
    </div>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>