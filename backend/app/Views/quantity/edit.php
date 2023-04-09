<?php

use App\Libraries\Hash;

foreach ($quantityInfo as $row) :
    if ($id == $row['id']) {
        $quantityRow = $row;
    }
endforeach;
?>
<div class="card">
    <div class="card-body">
        <form action="<?= site_url() ?>quantity/<?= Hash::path('addAction') ?>" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?= $quantityRow['quantity'] ?>">
                <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'quantity') : '' ?></small>
            </div>
            <input type="hidden" name="id" id="id" value="<?= $quantityRow['id'] ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="<?= site_url() ?>quantity/<?= Hash::path('view') ?>/0"><button type="button" class="btn btn-primary">Back</button></a>
            </div>
        </form>
    </div>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>