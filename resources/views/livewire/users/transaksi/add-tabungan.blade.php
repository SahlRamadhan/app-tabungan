<div>
    <div class="card mt-3">
        <div class="card-body">
            <form class="" wire:submit="submit">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Anggota ID</label>
                            <input type="number" class="form-control" id="description" placeholder="Enter Unik ID"
                                wire:model="uuid" readonly>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Name</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Description"
                                wire:model="name" readonly>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="Card">Jenis Pembayaran</label>
                            <select class="form-select" id="Card"
                                wire:change="$set('jenispembayaran_id', $event.target.value)"
                                wire:model="jenispembayaran_id">
                                <option selected>-- Select --</option>
                                @foreach ($jenisPembayaran as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="aApprox">Nominal</label>
                            <input type="number" class="form-control" id="aApprox" required=""
                                wire:model="amount">
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                @php
                    $selectedJenis = $jenisPembayaran->firstWhere('id', $jenispembayaran_id);
                @endphp

                @if ($selectedJenis && strtolower($selectedJenis->name) !== 'cash')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="attachment">Bukti Pembayaran</label>
                                <input class="form-control" type="file" id="attachment"
                                    wire:model="bukti_pembayaran">
                                <div wire:loading wire:target="bukti_pembayaran">Uploading...</div>
                            </div>

                            {{-- preview kalau sudah pilih file --}}
                            @if ($bukti_pembayaran)
                                <img src="{{ $bukti_pembayaran->temporaryUrl() }}" class="mt-2 mb-2" width="150">
                            @endif
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class="col-sm-12 text-start">
                        <button class="btn btn-primary px-4">Pay Now</button>
                        <button type="button" class="btn btn-danger px-4" wire:click="cancel">Cancel</button>
                    </div>
                </div>
            </form>
        </div><!--end card-body-->
    </div><!--end card-->



</div>
