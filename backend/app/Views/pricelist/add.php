<?php

use App\Libraries\Hash;
?>
<div class="card">
    <div class="card-body">
        <form action="<?= site_url() ?>pricelist/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="product">Product</label>
                <select class="form-control product" name="product" id="product">
                    <option selected disabled>Product</option>
                    <?php
                    foreach ($productsInfo as $key => $row) {
                    ?>
                        <option value="<?= $row['product'] ?>"><?= $row['product'] ?> m</option>
                    <?php
                    }
                    ?>
                    <option value="product" class="text-primary">Add Product</option>
                </select>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'product') : '' ?></small>
            </div>
            <div class="form-group mt-3">
                <label for="quantity">Quantity</label>
                <select class="form-control quantity" name="quantity" id="quantity">
                    <option selected disabled>Quantity</option>
                    <?php
                    foreach ($quantityInfo as $key => $row) {
                    ?>
                        <option value="<?= $row['quantity'] ?>"><?= $row['quantity'] ?> cft</option>
                    <?php
                    }
                    ?>
                    <option value="quantity" class="text-primary">Add Quantity</option>
                </select>
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'quantity') : '' ?></small>
            </div>
            <div class="form-group mt-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?= set_value('price') ?>">
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'price') : '' ?></small>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success">Save</button></div>
        </form>
    </div>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("change", ".product", function(e) {
            var data = $(this).val();
            if (data == "product")
                location.replace("<?= site_url() ?>products/<?= Hash::path('view') ?>/0");
        });
        $(document).on("change", ".quantity", function(e) {
            var data = $(this).val();
            if (data == "quantity")
                location.replace("<?= site_url() ?>quantity/<?= Hash::path('view') ?>/0");
        });
    });
</script>