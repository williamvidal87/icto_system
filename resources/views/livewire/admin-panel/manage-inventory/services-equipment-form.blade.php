<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Services</h3>
            <button type="button" class="close" wire:click="closeServicesEquipmentForm" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                        <div class="form-group">
                            <label for="equipment_type_id">Equipment Type</label>
                            <select class="form-control" id="equipment_type_id" wire:model="equipment_type_id">
                                <option>Select Equipment Type</option>
                                @foreach($select_equipment_type as $equipment_type)
                                    <option value="{{ $equipment_type->id }}">{{ $equipment_type->equipment_name }}</option>
                                @endforeach
                            </select>
                            @error('equipment_type_id') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" wire:model="description">
                            @error('description') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                
            </div>
            <!-- /.card-body -->

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeServicesEquipmentForm">Close</button>
                @if(!empty($this->ServicesEquipmentID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>
