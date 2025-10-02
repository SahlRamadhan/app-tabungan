<div>
    <div class="card mt-3">
        <div class="card-body">
            <form class="" wire:submit.prevent="submitPinjaman">
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
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Nomor KTP</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Description"
                                wire:model="no_ktp" readonly>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="description">Nomor Handphone</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Description"
                                wire:model="no_hp" readonly>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="aApprox">Nominal</label>
                            <input type="number" class="form-control" id="aApprox" required=""
                                wire:model.live="nominal">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!--end col-->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="aApprox">Tenor</label>
                            <input type="number" class="form-control" id="aApprox" required=""
                                wire:model.live="tenor">
                            @error('tenor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!--end col-->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="aApprox">Angsuran</label>
                            <input type="number" class="form-control" id="aApprox" required=""
                                wire:model="nominal_angsuran">
                            @error('nominal_angsuran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
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
