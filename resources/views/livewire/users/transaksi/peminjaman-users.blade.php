<div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Payments History</h4>

                            <div class="mt-3 d-flex gap-2">
                                <a href="{{ route('add-peminjaman') }}" class="btn btn-primary">Pinjam</a>

                                <a href="/" class="btn btn-warning">Anguran</a>

                            </div>
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
                                    <th class="border-top-0">No</th>
                                    <th class="border-top-0">Nomor Pinjaman</th>
                                    <th class="border-top-0">Unik ID</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Jenis Pembayaran</th>
                                    <th class="border-top-0">Nominal</th>
                                    <th class="border-top-0">Tenor</th>
                                    <th class="border-top-0">Angsuran</th>
                                    <th class="border-top-0">Tanggal Pinjaman</th>
                                    <th class="border-top-0">Tanggal Jatuh Tempo</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Approved By</th>
                                    {{-- <th class="border-top-0">Action</th> --}}
                                </tr><!--end tr-->
                            </thead>
                            <tbody>
                                @foreach ($pinjmanan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="">{{ $item->nomor_pinjaman }}</a></td>
                                        <td>{{ $item->user->uuid }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->jenisPembayaran->name }}</td>
                                        <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $item->tenor }} Bulan</td>
                                        <td>Rp. {{ number_format($item->nominal_angsuran, 0, ',', '.') }}</td>
                                        <td>{{ $item->tgl_pinjaman }}</td>
                                        <td>{{ $item->tgl_jatuhtempo }}</td>
                                        <td>
                                            @if ($item->status === 'padding')
                                                <span
                                                    class="badge bg-warning-subtle text-warning fs-11 fw-medium px-2">Pending</span>
                                            @elseif ($item->status === 'rejected')
                                                <span
                                                    class="badge bg-danger-subtle text-danger fs-11 fw-medium px-2">Failed</span>
                                            @else
                                                <span
                                                    class="badge bg-success-subtle text-success fs-11 fw-medium px-2">Success</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->approvedBy)
                                                <div>{{ $item->approvedBy->name }}</div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <a href="" wire:click="detail({{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenXxl"><i
                                                    class="las la-edit text-secondary font-16"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> <!--end table-->
                    </div><!--end /div-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->

    </div><!--end row-->
</div>
