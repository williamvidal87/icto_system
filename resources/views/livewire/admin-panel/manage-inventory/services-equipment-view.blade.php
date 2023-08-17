<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Services</h3>
            <button type="button" class="close" wire:click="closeServicesEquipmentView" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                        <div class="form-group">
                            <label for="equipment_type_id">Equipment Type</label>
                            <select disabled class="form-control" id="equipment_type_id" wire:model="equipment_type_id">
                                <option>Select Equipment Type</option>
                                @foreach($select_equipment_type as $equipment_type)
                                    <option value="{{ $equipment_type->id }}">{{ $equipment_type->equipment_name }}</option>
                                @endforeach
                            </select>
                            @error('equipment_type_id') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input disabled type="text" class="form-control" id="description" wire:model="description">
                            @error('description') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_id">Status </label>
                            <input disabled type="text" class="form-control" id="status_id" wire:model="status_id">
                        </div>
                
            </div>
            <!-- /.card-body -->

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeServicesEquipmentView">Close</button>
                <div>
                    @if($this->status_check==6)
                        <button type="button" class="btn btn-danger" wire:click="setNotAvailableServices({{$this->ServicesEquipmentID}})"><i class="fas fa-exclamation-triangle"></i> Set Not Available</button>
                    @endif
                    @if($this->status_check==11)
                        <button type="button" class="btn btn-success" wire:click="setAvailableServices({{$this->ServicesEquipmentID}})"><i class="fa fa-undo"></i> Set Available</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
