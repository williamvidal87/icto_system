<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Inventory Equipment</h3>
            <button type="button" class="close" wire:click="closeInventoryEquipmentForm" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="device_name">Device Name </label>
                            <input type="text" class="form-control" id="device_name" wire:model="device_name">
                            @error('device_name') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="property_no">Property No. (<small>Optional</small>)</label>
                            <input type="text" class="form-control" id="property_no" wire:model="property_no">
                            @error('property_no') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="serial_no">Serial No. (<small>Optional</small>)</label>
                            <input type="text" class="form-control" id="serial_no" wire:model="serial_no">
                            @error('serial_no') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="specs">Specs (<small>Optional</small>)</label>
                            <textarea class="form-control" rows="3" id="specs" wire:model="specs"></textarea>
                            @error('specs') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="acquisition_date">Acquisition Date (<small>Optional</small>)</label>
                            <input type="datetime-local" class="form-control" id="acquisition_date" name="acquisition_date" wire:model="acquisition_date">
                            @error('acquisition_date') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <label for=""><h3 class="card-title"><strong>Upload Photo</strong></h3> (<small>Optional</small>)</label>
                        <div class="form-group">
                            Photo Preview:
                            @foreach ($this->images as $image)
                            @endforeach
                            <div class="row">
                                @foreach ($this->images as $image)
                                @endforeach
                                @if($this->edit_data==1)
                                
                                    @foreach ($this->images as $image)
                                        <div class="mb-1 col-3 card me-1">
                                            @if($this->temp_images==$this->images)
                                                <a href="/storage/{{ $image }}" alt="Image View" target="_blank">
                                                <img src="/storage/{{ $image }}"></a>
                                            @else
                                                <img src="{{ $image->temporaryUrl() }}">
                                            @endif
                                        </div>
                                    @endforeach
                                
                                @else
                                
                                    @foreach ($this->images as $image)
                                        <div class="mb-1 col-3 card me-1">
                                            <img src="{{ $image->temporaryUrl() }}">
                                        </div>
                                    @endforeach
                                
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Image Type</label>
                                <input type="file" id="images" class="form-control" wire:model="images" multiple accept="image/*">
                                <div wire:loading wire:target="images">Uploading...</div>
                                @error('images.*') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeInventoryEquipmentForm">Close</button>
                @if(!empty($this->InventoryEquipmentID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>