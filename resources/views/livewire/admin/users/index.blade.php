<div>
    @if ($formEdit)
        <div class="row justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Form Input User</h4>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <form wire:submit="update">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="name" class="form-control" id="username" aria-describedby="emailHelp"
                                    placeholder="Masukkan Username" wire:model="name_id">
                                @error('name_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan Email" wire:model="email_id">
                                @error('email_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="notelepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="notelepon"
                                    placeholder="Masukkan Nomer Telepon" wire:model="no_hp_id">
                                @error('no_hp_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nonik" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="nonik" placeholder="Masukkan NIK"
                                    wire:model="no_ktp_id">
                                @error('no_ktp_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nonik" class="form-label">Alamat</label>
                                <textarea class="form-control" wire:model="alamat_id" id="alamat_id" cols="30" rows="10"></textarea>
                                @error('alamat_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Update</button>
                            <a wire:click="$set('formEdit', false)" class="btn btn-danger">Kembali</a>
                        </form>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    @else
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
        <div class="">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <a href="{{ route('admin.users.tambah') }}" class="btn btn-lg btn-primary">Tambah</a>
                            </div><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table  mb-0 table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Unik ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>No NIK</th>
                                        <th>Alamat</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->uuid }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->no_hp }}</td>
                                            <td>{{ $user->no_ktp }}</td>
                                            <td>{{ $user->alamat }}</td>
                                            <td>{{ number_format($user->balances->first()?->amount ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>{{ number_format($user->balances->sum('amount'), 0, ',', '.') }}</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <span
                                                        class="badge rounded text-success bg-success-subtle">{{ $user->status }}</span>
                                                @else()
                                                    <span
                                                        class="badge rounded text-danger bg-secondary-subtle">{{ $user->status }}</span>
                                                @endif
                                            <td class="text-end">
                                                <a wire:click="edit({{ $user->id }})"><i
                                                        class="las la-pen text-secondary font-16"></i></a>
                                                <a wire:click="delete({{ $user->id }})"><i
                                                        class="las la-trash-alt text-secondary font-16"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    @endif
</div>
