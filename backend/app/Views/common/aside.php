<?php

use App\Libraries\Hash;
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>dashboard/<?= Hash::path('index') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>pricelist/<?= Hash::path('view') ?>/0" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">PriceList</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>booking/<?= Hash::path('view') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Booking</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>expenses/<?= Hash::path('view') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Expenses</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>customers/<?= Hash::path('view') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Customers</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() ?>reports/<?= Hash::path('index') ?>/all" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Reports</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>