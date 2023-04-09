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
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title"><?= $pageHeading ?></h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?= csrf_field(); ?>
                <?php

                use App\Libraries\Hash;

                if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Quantity</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($quantityInfo as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $row['quantity'] ?> cft</td>
                                                <td>
                                                    <button type="button" id="edit" class="btn btn-cyan btn-sm rounded text-white edit" value='{"id" :"<?= $row['id'] ?>"}'> Edit </button>
                                                    <button type="button" class="btn btn-danger btn-sm rounded text-white delete" value='{"id" :"<?= $row['id'] ?>"}'> Delete </button>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Quantity</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <?= $id == 0 ? view('quantity/add') : view('quantity/edit') ?>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>
<script>
    $(document).ready(function() {
        $(document).on("click", ".edit", function(e) {
            var data = $(this);
            var values = JSON.parse(data.val());
            var id = values.id;
            location.replace("<?= site_url() ?>quantity/<?= Hash::path('view') ?>/" + id);
        });
        $(document).on("click", ".delete", function(e) {
            var data = $(this);
            var values = JSON.parse(data.val());
            var id = values.id;
            location.replace("<?= site_url() ?>quantity/<?= Hash::path('delete') ?>/" + id);
        });
    });
</script>