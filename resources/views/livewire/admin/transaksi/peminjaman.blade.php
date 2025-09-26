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
                            <h4 class="card-title">All Peminjaman</h4>

                            <!-- Search Form -->
                            <div class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                                <div class="hide-phone app-search mt-3">
                                    <form role="search" action="#" method="get" class="d-flex mt-2">
                                        <input type="search" wire:model.live= 'search' name="search"
                                            class="form-control top-search mb-0" placeholder="Search here...">
                                        <button type="submit" class="btn btn-primary ms-2">
                                            <i class="iconoir-search"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icofont-calendar fs-5 me-1"></i> Filter<i
                                        class="las la-angle-down ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#"
                                        wire:click.prevent="setRange('today')">Today</a>
                                    <a class="dropdown-item" href="#"
                                        wire:click.prevent="setRange('last_week')">Last Week</a>
                                    <a class="dropdown-item" href="#"
                                        wire:click.prevent="setRange('last_month')">Last Month</a>
                                    <a class="dropdown-item" href="#"
                                        wire:click.prevent="setRange('this_year')">This Year</a>
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
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Uiid</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Jenis Pembayaran</th>
                                    <th class="border-top-0">Nominal</th>
                                    <th class="border-top-0">Tenor</th>
                                    <th class="border-top-0">Nominal Angsuran</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Approved By</th>
                                    <th class="border-top-0">Tanggal Peminjaman</th>
                                    <th class="border-top-0">Action</th>
                                </tr><!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $pinjam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <a href="" wire:click="detail({{ $pinjam->id }})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModalFullscreenXxl">{{ $pinjam->nomor_pinjaman }}</a>
                                        </td>
                                        <td>{{ $pinjam->user->uuid ?? '-' }}</td>
                                        <td>{{ $pinjam->user->name ?? '-' }}</td>
                                        <td>{{ $pinjam->jenisPembayaran->name ?? '-' }}</td>
                                        <td>Rp. {{ number_format($pinjam->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $pinjam->tenor }} Bulan</td>
                                        <td>Rp. {{ number_format($pinjam->nominal_angsuran, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($pinjam->status === 'padding')
                                                <span
                                                    class="badge bg-warning-subtle text-warning fs-11 fw-medium px-2">Pending</span>
                                            @elseif ($pinjam->status === 'rejected')
                                                <span
                                                    class="badge bg-danger-subtle text-danger fs-11 fw-medium px-2">Failed</span>
                                            @elseif ($pinjam->status === 'approved')
                                                <span
                                                    class="badge bg-success-subtle text-success fs-11 fw-medium px-2">Success</span>
                                            @else
                                                <span
                                                    class="badge bg-info-subtle text-info fs-11 fw-medium px-2">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pinjam->approvedBy)
                                                <div>{{ $pinjam->approvedBy->name }}</div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pinjam->created_at->setTimezone('Asia/Jakarta')->format('d F Y')}}
                                        </td>
                                        <td>
                                            @if ($pinjam->status === 'padding')
                                                @auth
                                                    @if (Auth::user()->role === 'admin')
                                                        <button wire:click="terima({{ $pinjam->id }})"
                                                            class="btn btn-primary btn-sm">Terima</button>
                                                        <button wire:click="tolak({{ $pinjam->id }})"
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
                        <div class="mb-2 mb-lg-0">
                            <a href="{{ route('admin.transaksi.peminjaman.tambah') }}"  class="btn btn-primary px-4">Add Transaction</a>
                        </div>
                        <div>
                            {{-- {{ $pinjam->links('vendor.pagination.custom') }} --}}
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->

    </div><!--end row-->

    {{-- <div wire:ignore.self class="modal fade" id="modalAddTransaksi" tabindex="-1"
        aria-labelledby="exampleModalFullscreenXxlLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalFullscreenXxlLabel">Add Transaction</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="" wire:submit.prevent="addTransaksi">
                        <div class="mb-3">
                            <label for="user" class="form-label">Name</label>
                            <input type="text" id="user" class="form-control"
                                placeholder="Search user by name or email" wire:model.live="query"
                                autocomplete="off">
                            @if (!empty($users))
                                <ul class="list-group position-absolute w-100" style="z-index: 1000;">
                                    @foreach ($users as $user)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectUser('{{ $user->id }}')">
                                            {{ $user->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-3">
                                @if ($selectedUser)
                                    <label for="user" class="form-label">UUID</label>
                                    <input type="text" id="user" class="form-control" readonly
                                        value="{{ $selectedUser ? $selectedUser['uuid'] : 'No user selected' }}">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" class="form-select" wire:model="type">
                                <option value="">Select Type</option>
                                <option value="deposit">Deposit</option>
                                <option value="withdraw">Withdraw</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" id="amount" class="form-control" wire:model="amount">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}
    <!-- Modal Detail -->
    {{-- <div wire:ignore.self class="modal fade" id="exampleModalFullscreenXxl" tabindex="-1"
        aria-labelledby="exampleModalFullscreenXxlLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
                @if ($detailtransaksi)
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalFullscreenXxlLabel">Detail Transaksi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                        <h6>Tanggal Transaksi :
                            {{ $detailtransaksi->created_at->setTimezone('Asia/Jakarta')->format('d F Y h:ia') }}</h6>
                        <h6>Tanggal Approved :
                            {{ $detailtransaksi->approved_at ? $detailtransaksi->approved_at->setTimezone('Asia/Jakarta')->format('d F Y H:i') : '' }}
                        </h6>
                        @if (
                            $detailtransaksi->jenisPembayaran &&
                                strtolower($detailtransaksi->jenisPembayaran->name) !== 'cash' &&
                                $detailtransaksi->bukti_pembayaran)
                            <h6>Bukti Pembayaran :</h6>
                            <img src="{{ asset('/buktipembayaran/images/' . $detailtransaksi->bukti_pembayaran) }}"
                                alt="Bukti Pembayaran" class="img-fluid" style="max-width: 300px;">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
</div>
