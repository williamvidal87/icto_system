<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ServiceType</h3>
            <button type="button" class="close" wire:click="closeServiceTypeForm" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="equipment_name">Equipment Name</label>
                    <input type="text" class="form-control" id="equipment_name" wire:model="equipment_name">
                    @error('equipment_name') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- /.card-body -->
            
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeServiceTypeForm">Close</button>
                @if(!empty($this->ServiceTypeID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>