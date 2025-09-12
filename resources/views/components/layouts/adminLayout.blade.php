<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>


    <meta charset="utf-8" />
    <title>Dashboard | Approx - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/admin/assets/images/favicon.ico">



    <!-- App css -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar d-print-none">
        <div class="container-fluid">
            <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">


                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                    <li>
                        <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                            <i class="iconoir-menu"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" action="#" method="get">
                            <input type="search" name="search" class="form-control top-search mb-0"
                                placeholder="Search here...">
                            <button type="submit"><i class="iconoir-search"></i></button>
                        </form>
                    </li>
                </ul>
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">

                    <li class="topbar-item">
                        <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                            <i class="iconoir-half-moon dark-mode"></i>
                            <i class="iconoir-sun-light light-mode"></i>
                        </a>
                    </li>


                    <li class="dropdown topbar-item">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                            <img src="/admin/assets/images/users/avatar-1.jpg" alt=""
                                class="thumb-md rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0">
                            <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                <div class="flex-shrink-0">
                                    <img src="/admin/assets/images/users/avatar-1.jpg" alt=""
                                        class="thumb-md rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                    <h6 class="my-0 fw-medium text-dark fs-13">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted mb-0">{{ Auth::user()->email }}</small>
                                </div><!--end media-body-->
                            </div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="/admin/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span class="">
                    <img src="/admin/assets/images/logo-light.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="/admin/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu">
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label mt-2">
                            <span>Main</span>
                        </li>

                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item @if (Request::segment(2) == 'dashboard') active @endif">
                                <a class="nav-link " href="{{ route('admin.dashboard') }}">
                                    <i class="iconoir-report-columns menu-icon"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebarElements" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarElements">
                                    <i class="iconoir-compact-disc menu-icon"></i>
                                    <span>Users</span>
                                </a>
                                <div class="collapse " id="sidebarElements">
                                    <ul class="nav flex-column">
                                        <li class="nav-item @if (Request::segment(2) == 'users') active @endif">
                                            <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                                        </li><!--end nav-item-->
                                        <li class="nav-item @if (Request::segment(2) == 'tambah') active @endif">
                                            <a class="nav-link" href="{{ route('admin.users.tambah') }}">Tambah</a>
                                        </li><!--end nav-item-->
                                    </ul><!--end nav-->
                                </div><!--end startbarElements-->
                            </li><!--end nav-item-->
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebarTransaksi" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarTransaksi">
                                    <i class="iconoir-compact-disc menu-icon"></i>
                                    <span>Transaksi</span>
                                </a>
                                <div class="collapse " id="sidebarTransaksi">
                                    <ul class="nav flex-column">
                                        <li class="nav-item @if (Request::segment(2) == 'tabungan') active @endif ">
                                            <a class="nav-link"
                                                href="{{ route('admin.transaksi.tabungan') }}">Tabungan</a>
                                        </li><!--end nav-item-->
                                        <li class="nav-item @if (Request::segment(2) == 'peminjaman') active @endif">
                                            <a class="nav-link"
                                                href="{{ route('admin.transaksi.peminjaman') }}">Peminjaman</a>
                                        </li><!--end nav-item-->
                                    </ul><!--end nav-->
                                </div><!--end startbarElements-->
                            </li><!--end nav-item-->
                        @else
                            <li class="nav-item @if (Request::segment(1) == 'dashboard') active @endif">
                                <a class="nav-link " href="{{ route('dashboard') }}">
                                    <i class="iconoir-report-columns menu-icon"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li><!--end nav-item-->
                             <li class="nav-item">
                                <a class="nav-link" href="#sidebarTransaksi" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarTransaksi">
                                    <i class="iconoir-compact-disc menu-icon"></i>
                                    <span>Transaksi</span>
                                </a>
                                <div class="collapse " id="sidebarTransaksi">
                                    <ul class="nav flex-column">
                                        <li class="nav-item @if (Request::segment(1) == 'tabungan') active @endif ">
                                            <a class="nav-link"
                                                href="{{ route('tabungan') }}">Tabungan</a>
                                        </li><!--end nav-item-->
                                        <li class="nav-item @if (Request::segment(1) == 'peminjaman') active @endif">
                                            <a class="nav-link"
                                                href="{{ route('peminjaman') }}">Peminjaman</a>
                                        </li><!--end nav-item-->
                                    </ul><!--end nav-->
                                </div><!--end startbarElements-->
                            </li><!--end nav-item-->
                        @endif

                    </ul><!--end navbar-nav--->
                </div>
            </div><!--end startbar-collapse-->
        </div><!--end startbar-menu-->
    </div><!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                {{ $slot }}
            </div><!-- container -->

            <!--Start Footer-->

            <footer class="footer text-center text-sm-start d-print-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-0 rounded-bottom-0">
                                <div class="card-body">
                                    <p class="text-muted mb-0">
                                        ©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        Approx
                                        <span class="text-muted d-none d-sm-inline-block float-end">
                                            Design with
                                            <i class="iconoir-heart-solid text-danger align-middle"></i>
                                            by Mannatthemes</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/assets/libs/simplebar/simplebar.min.js"></script>

    <script src="/admin/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="https://apexcharts.com/samples//admin/assets/stock-prices.js"></script>
    <script src="/admin/assets/js/pages/index.init.js"></script>
    <script src="/admin/assets/js/DynamicSelect.js"></script>
    <script src="/admin/assets/js/app.js"></script>
</body>
<!--end body-->

</html>
