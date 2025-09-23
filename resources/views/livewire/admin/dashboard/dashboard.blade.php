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
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($netBalance, 0, ',', '.') }} </h4>
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
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total User</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ $user }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        {{-- <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total User Bulan Ini</p>
                            <h4 class="mt-1 mb-0 fw-medium">{{ $userBaruBulanIni }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col --> --}}

        <div class="col-md-3">
            <div class="card bg-corner-img">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-9">
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Uang Masuk Bulan Ini</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($uangMasukBulanIni, 0, ',', '.') }}
                            </h4>
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
                            <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Uang Keluar Bulan Ini</p>
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($uangKeluarBulanIni, 0, ',', '.') }}
                            </h4>
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
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($totalUangMasuk, 0, ',', '.') }}</h4>
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
                            <h4 class="mt-1 mb-0 fw-medium">Rp. {{ number_format($totalUangKeluar, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!--end row-->
</div>
