<div>
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Borrow Equipment Request</h3>
        <button type="button" class="close" wire:click="closeBorrowEquipmentRequestView" id="button-reset">
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
                        <label for="request_no">Request No.</label>
                        <input type="text" class="form-control" id="request_no" wire:model="request_no" disabled>
                    </div>
                    <div class="form-group">
                        <label for="user_office_info">End-User/Office Info </label>
                        <input type="text" class="form-control" id="user_office_info" wire:model="user_office_info" disabled>
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose </label>
                        <input type="text" class="form-control" id="purpose" wire:model="purpose" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="status_id">Status </label>
                        <input type="text" class="form-control" id="status_id" wire:model="status_id" disabled>
                    </div>
                    <label for="sample"><h3 class="card-title"><strong>Uploaded Letter</strong> </h3></label>
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
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Equipment to borrow</label>
                        <table class="table" id="products_table">
                            <thead>
                                <tr>
                                    <th width="100%">Inventory Equipment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderProducts as $index => $orderProduct)
                                <tr>
                                    <td>
                                        <select name="orderProducts[{{$index}}][device_id]"
                                            wire:model="orderProducts.{{$index}}.device_id"
                                            class="form-control" required disabled>
                                            <option value="">-- choose product --</option>
                                            @foreach ($select_items as $product)
                                            <option <?php 
                                                        for ($i=0; $i < count($this->orderProducts); $i++) {
                                                        if(!empty($this->orderProducts[$i]['device_id'])){
                                                            if ($product->id == $this->orderProducts[$i]['device_id']) {
                                                            if ($this->orderProducts[$index]['device_id'] == $this->orderProducts[$i]['device_id']) {
                                                              // echo "none";
                                                            } else {
                                                            echo "disabled";
                                                            }
                                                            }
                                                        }
                                                        }
                                                ?> value="{{ $product->id }}">{{ $product->device_name }} - DE{{ 1002039200+$product->id }} - {{ $product->property_no ?? "none" }} - {{ $product->serial_no ?? "none" }} - {{ $product->specs ?? "none" }}<?php 
                                                        for ($i=0; $i < count($this->orderProducts); $i++) {
                                                        if(!empty($this->orderProducts[$i]['device_id'])){
                                                            if ($product->id == $this->orderProducts[$i]['device_id']) {
                                                            if ($this->orderProducts[$index]['device_id'] == $this->orderProducts[$i]['device_id']) {
                                                              // echo "none";
                                                            } else {
                                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You Already taken.";
                                                            }
                                                            }
                                                        }
                                                        }
                                                ?></option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeBorrowEquipmentRequestView">Close</button>
                @if($this->status_check==3)
                    <p><strong>Remarks: </strong>{{ $this->cancel_reason ?? "none" }}</p>
                @endif
            </div>
        </form>
    </div>
</div>