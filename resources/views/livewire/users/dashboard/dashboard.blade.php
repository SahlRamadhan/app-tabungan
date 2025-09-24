<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Approx</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Saldo</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($totalSaldo, 0, ",", ".") }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                <i class="iconoir-dollar-circle fs-22 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Uang Masuk</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($totalIn, 0, ",", ".") }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div class="d-flex align-items-center thumb-md border-dashed border-info rounded mx-auto">
                                <i class="iconoir-cart fs-22 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Uang Keluar</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($totalOut, 0, ",", ".") }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div
                                class="d-flex align-items-center thumb-md border-dashed border-warning rounded mx-auto">
                                <i class="iconoir-percentage-circle fs-22 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Transaksi</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ number_format($totalTransaksi, 0, ",", ".") }}</h4>
                        </div>
                        <div class="col-3 align-self-center">
                            <div class="d-flex align-items-center thumb-md border-dashed border-danger rounded mx-auto">
                                <i class="iconoir-hexagon-dice fs-22 text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!--end row-->
</div>
