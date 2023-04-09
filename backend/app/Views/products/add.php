<?php

use App\Libraries\Hash;
?>
<div class="card">
    <div class="card-body">
        <form action="<?= site_url() ?>products/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="product">Product</label>
                <input type="text" class="form-control" name="product" id="product" placeholder="Product" value="<?= set_value('product') ?>">
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'product') : '' ?></small>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success">Save</button></div>
        </form>
    </div>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>