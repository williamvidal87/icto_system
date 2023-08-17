<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Technical Request</h3>
            <button type="button" class="close" wire:click="closeTechnicalRequestForm" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="user_office_info">End-User </label>
                    <input type="text" class="form-control" id="user_office_info" wire:model="user_office_info">
                    @error('user_office_info') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="problem">Problem (<small>e.g. Computer  Blue Screen</small>)</label>
                    <input type="text" class="form-control" id="problem" wire:model="problem">
                    @error('problem') <span class="error">{{ $message }}</span> @enderror
                </div>
                <label for="problem"><h3 class="card-title"><strong>Upload Letter</strong></h3> (<small>Optional</small>)</label>
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
            
            
            
            
            
                <div class="form-group">
                    PDF Preview:
                    @foreach ($this->letters as $letter)
                    @endforeach
                    @foreach ($this->letters as $letter)
                    @endforeach
                    @if($this->edit_data==1)
                        @if($this->temp_letters==$this->letters)
                            <div class="row">
                                @foreach ($this->letters as $letter)
                                    <div class="mb-1 col-3 card me-1">
                                        <embed src="/storage/{{ $letter }}"/>
                                        <a href="/storage/{{$letter}}" target="_blank">View</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @foreach ($this->letters as $letter)
                                <ul>
                                    <li>
                                        <i class="fas fa-file-pdf" style='font-size:20px;color:red'><a style="color: black">{{ basename($letter) }}</a></i>
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    @else
                        @foreach ($this->letters as $letter)
                            <ul>
                                <li>
                                    <i class="fas fa-file-pdf" style='font-size:20px;color:red'><a style="color: black">{{ basename($letter) }}</a></i>
                                </li>
                            </ul>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="letters" class="form-label">PDF Type</label>
                        <input type="file" id="letters" class="form-control" wire:model="letters" multiple accept="application/pdf">
                        <div wire:loading wire:target="letters">Uploading...</div>
                        @error('letters.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            
            
            
            
            
            </div>
            <!-- /.card-body -->
            
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeTechnicalRequestForm">Close</button>
                @if(!empty($this->TechnicalRequestID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>