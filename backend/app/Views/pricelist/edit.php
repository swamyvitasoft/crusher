<?php

use App\Libraries\Hash;

foreach ($pricelistInfo as $row) :
    if ($price_id != 0) {
        $pricelistRow = $row;
    }
endforeach;
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
                        if ($row['product'] == $pricelistRow['product'])
                            $selected = 'selected';
                        else
                            $selected = '';
                    ?>
                        <option value="<?= $row['product'] ?>" <?= $selected ?>><?= $row['product'] ?> m</option>
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
                        if ($row['quantity'] == $pricelistRow['quantity'])
                            $selected = 'selected';
                        else
                            $selected = '';
                    ?>
                        <option value="<?= $row['quantity'] ?>" <?= $selected ?>><?= $row['quantity'] ?> cft</option>
                    <?php
                    }
                    ?>
                </select>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'quantity') : '' ?></small>
            </div>
            <div class="form-group mt-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?= $pricelistRow['price'] ?>">
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price') : '' ?></small>
            </div>
            <input type="hidden" name="price_id" id="price_id" value="<?= $pricelistRow['price_id'] ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="<?= site_url() ?>pricelist/<?= Hash::path('view') ?>/0"><button type="button" class="btn btn-primary">Back</button></a>
            </div>
        </form>
    </div>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>