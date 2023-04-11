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
            <h1>Welcome <?= $loggedInfo['name'] ?>,
                <div class="row mt-3">
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <?= $today['today_loads'] ?>
                                </h1>
                                <h6 class="text-white">Loads Today</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <?= $today['today_income'] ?>
                                </h1>
                                <h6 class="text-white">Income Today</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">
                                    <?= $today['today_expenses'] ?>
                                </h1>
                                <h6 class="text-white">Expenses Today</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <?= $today['today_pending'] ?>
                                </h1>
                                <h6 class="text-white">Pending Today</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <?= $cm['cm_loads'] ?>
                                </h1>
                                <h6 class="text-white">Loads Month</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <?= $cm['cm_income'] ?>
                                </h1>
                                <h6 class="text-white">Income Month</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <?= $cm['cm_expenses'] ?>
                                </h1>
                                <h6 class="text-white">Expenses Month</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <?= $cm['cm_pending'] ?>
                                </h1>
                                <h6 class="text-white">Pending Month</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <?= $cy['cy_loads'] ?>
                                </h1>
                                <h6 class="text-white">Loads Year</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">
                                    <?= $cy['cy_income'] ?>
                                </h1>
                                <h6 class="text-white">Income Year</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <?= $cy['cy_expenses'] ?>
                                </h1>
                                <h6 class="text-white">Expenses Year</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <?= $cy['cy_pending'] ?>
                                </h1>
                                <h6 class="text-white">Pending Year</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <?= $customers ?>
                                </h1>
                                <h6 class="text-white">Customers</h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>