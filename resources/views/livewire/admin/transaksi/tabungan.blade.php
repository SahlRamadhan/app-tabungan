<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Payments</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Approx</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">All Transactions</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icofont-calendar fs-5 me-1"></i> This Month<i
                                        class="las la-angle-down ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">This Year</a>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Type</th>
                                    <th class="border-top-0">Nominal</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Approved By</th>
                                    <th class="border-top-0">Approved At</th>
                                    <th class="border-top-0">Action</th>
                                </tr><!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($balances as $balance)
                                    <tr>
                                        <td> <a href="" wire:click="detail({{ $balance->id }})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModalFullscreenXxl">{{ $balance->created_at->setTimezone('Asia/Jakarta')->format('d F Y h:ia') }}</a>
                                        </td>
                                        <td>{{ $balance->jenisPembayaran->name }}</td>
                                        <td>Rp. {{ number_format($balance->amount, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($balance->status === 'padding')
                                                <span
                                                    class="badge bg-warning-subtle text-warning fs-11 fw-medium px-2">Pending</span>
                                            @elseif ($balance->status === 'out')
                                                <span
                                                    class="badge bg-danger-subtle text-danger fs-11 fw-medium px-2">Failed</span>
                                            @else
                                                <span
                                                    class="badge bg-success-subtle text-success fs-11 fw-medium px-2">Success</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($balance->approvedBy)
                                                <div>{{ $balance->approvedBy->name }}</div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{ $balance->approved_at ? $balance->approved_at->setTimezone('Asia/Jakarta')->format('d F Y H:i') : '' }}
                                        </td>
                                        <td>
                                            @if ($balance->status === 'padding')
                                                @auth
                                                    @if (Auth::user()->role === 'admin')
                                                        <button wire:click="terima({{ $balance->id }})"
                                                            class="btn btn-primary btn-sm">Terima</button>
                                                        <button wire:click="tolak({{ $balance->id }})"
                                                            class="btn btn-danger btn-sm">Tolak</button>
                                                    @else
                                                        <span class="text-muted">No actions</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">No actions</span>
                                                @endauth
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr><!--end tr-->
                                @endforeach
                            </tbody>
                        </table> <!--end table-->
                    </div><!--end /div-->
                    <div class="d-lg-flex justify-content-lg-between mt-2">
                        <div>
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul><!--end pagination-->
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->

    </div><!--end row-->

    <div wire:ignore.self class="modal fade" id="exampleModalFullscreenXxl" tabindex="-1"
        aria-labelledby="exampleModalFullscreenXxlLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
                @if ($detailtransaksi)
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalFullscreenXxlLabel">Detail Transaksi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Id Anggota : {{ $detailtransaksi->user->uuid }}</h6>
                        <h6>Nama Anggota : {{ $detailtransaksi->user->name }}</h6>
                        <h6>Jenis Pembayaran : {{ $detailtransaksi->jenisPembayaran->name }}</h6>
                        <h6>Nominal : Rp. {{ number_format($detailtransaksi->amount, 0, ',', '.') }}</h6>
                        <h6>Status :
                            @if ($detailtransaksi->status === 'padding')
                                <span class="badge bg-warning-subtle text-warning fs-11 fw-medium px-2">Pending</span>
                            @elseif ($detailtransaksi->status === 'out')
                                <span class="badge bg-danger-subtle text-danger fs-11 fw-medium px-2">Failed</span>
                            @else
                                <span class="badge bg-success-subtle text-success fs-11 fw-medium px-2">Success</span>
                            @endif
                        </h6>
                        <h6>Tanggal Transaksi : {{ $detailtransaksi->created_at->setTimezone('Asia/Jakarta')->format('d F Y h:ia') }}</h6>
                        <h6>Tanggal Approved : {{ $detailtransaksi->approved_at ? $detailtransaksi->approved_at->setTimezone('Asia/Jakarta')->format('d F Y H:i') : '' }}</h6>
                        <h6>Bukti Pembayaran :</h6>
                        <img src="{{ asset('/buktipembayaran/images/' . $detailtransaksi->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran" class="img-fluid" style="max-width: 300px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
