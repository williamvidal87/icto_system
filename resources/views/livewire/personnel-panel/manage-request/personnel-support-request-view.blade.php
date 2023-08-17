<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">IT Support Service Request</h3>
            <button type="button" class="close" wire:click="closeITSupportServicesRequestView" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form enctype="multipart/form-data">
            <div class="card-body">
                @if(!empty($this->WorkTicketID))
                    <label for="personnel_id">Work Ticket No:TK{{ 1231339100+$this->WorkTicketID }}</label>
                @endif
                <div class="row">
                    <div class="col-sm-6">
                    
                        <div class="form-group">
                            <label for="personnel_id">Assign Personnel</label>
                            <select class="form-control" id="personnel_id" wire:model="personnel_id" required <?php
                                if($this->status_check!=1){
                                    echo "disabled";
                                }
                            ?>>
                                <option value="0">Select a Personnel</option>
                                @foreach($assign_personnel as $personnel)
                                <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                                @endforeach
                            </select>
                            @error('personnel_id') <span class="error" style="color: red">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="request_no">Request No.</label>
                            <input type="text" class="form-control" id="request_no" wire:model="request_no" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="event_information">Event Information</label>
                            <input type="text" class="form-control" id="event_information"
                                wire:model="event_information" required disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="person_incharge">Person In-Charge</label>
                            <input type="text" class="form-control" id="person_incharge" wire:model="person_incharge"
                                required disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="schedule">Set Schedule</label>
                            <input type="datetime-local" class="form-control" id="schedule" name="schedule"
                                wire:model="schedule" disabled>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-6">
                    
                        <div class="form-group">
                            <label for="status_id">Status </label>
                            <input type="text" class="form-control" id="status_id" wire:model="status_id" disabled
                                disabled>
                        </div>
                        
                        <div class="form-group">
                            <label>Services Needed</label>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <th>Type of Service</th>
                                </div>
                                <div class="col-sm-6">
                                    <th>Description</th>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="height: 120px; overflow-y: scroll;">
                        
                            <table class="table" id="products_table">
                                <tbody>
                                    @foreach ($orderProducts as $index => $orderProduct)
                                    <tr>
                                        <td>
                                            <select name="orderProducts[{{$index}}][item_id]"
                                                wire:model="orderProducts.{{$index}}.item_id" class="form-control" required
                                                disabled>
                                                <option value="">-- choose Service --</option>
                                                @foreach ($select_items as $product)
                                                <option value="{{ $product->id }}">{{ $product->equipment_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="orderProducts[{{$index}}][itemdes_id]"
                                                wire:model="orderProducts.{{$index}}.itemdes_id" class="form-control" required
                                                disabled>
                                                <option value="">-- choose Description --</option>
                                                @foreach ($select_des as $product2)
                                                @if ($this->orderProducts[$index]['item_id']==$product2->equipment_type_id)
                                                    
                                                    <option <?php for ($i=0; $i < count($this->orderProducts); $i++) {
                                                        if(!empty($this->orderProducts[$i]['itemdes_id'])){
                                                        if ($product2->id == $this->orderProducts[$i]['itemdes_id']) {
                                                        if ($this->orderProducts[$index]['itemdes_id'] ==
                                                        $this->orderProducts[$i]['itemdes_id']) {
                                                        // echo "none";
                                                        } else {
                                                        echo "disabled";
                                                        }
                                                        }
                                                        }
                                                        }
                                                        ?> value="{{ $product2->id }}">{{ $product2->description }}
                                                        <?php
                                                        for ($i=0; $i < count($this->orderProducts); $i++) {
                                                        if(!empty($this->orderProducts[$i]['itemdes_id'])){
                                                        if ($product2->id == $this->orderProducts[$i]['itemdes_id']) {
                                                            if ($this->orderProducts[$index]['itemdes_id'] == $this->orderProducts[$i]['itemdes_id']) {
                                                                    // echo "none";
                                                            } else {
                                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You Already taken.";
                                                            }
                                                        }
                                                        }
                                                        }
                                                        ?>
                                                    </option>
                                                    
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- end sample --}}
                        </div>
                        <label for="problem">
                            <h3 class="card-title"><strong>Uploaded Letter</strong> </h3>
                        </label>
                        <div class="form-group">
                            PDF Preview:
                            @foreach ($this->letters as $letter)
                            @endforeach
                            @foreach ($this->letters as $letter)
                            @endforeach
                            @if($this->edit_data==1)
                            @if($this->temp_letters==$this->letters)
                            <div class="row" style="height: 120px; overflow-y: scroll;">
                                @foreach ($this->letters as $letter)
                                <div class="mb-1 col-3 card me-1">
                                    <embed src="/storage/{{ $letter }}" />
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
                                    <i class="fas fa-file-pdf" style='font-size:20px;color:red'><a style="color: black">{{
                                            basename($letter) }}</a></i>
                                </li>
                            </ul>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    
                </div>
                
                    





            </div>
            <!-- /.card-body -->


            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeITSupportServicesRequestView">Close</button>
                <div>
                    @if($this->status_check==2)
                        <button type="button" class="btn btn-secondary" wire:click="changepersonnel"><i class="fas fa-user"></i> Change Personnel</button>
                    @endif
                    @if($this->status_check==2)
                        <button type="button" class="btn btn-warning" wire:click="ongoing"><i class="fas fa-thumbs-up"></i> Set Ongoing</button>
                    @endif
                    @if($this->status_check==4)
                        <button type="button" class="btn btn-success" wire:click="completed "><i class="fas fa-check"></i> Set Completed</button>
                    @endif
                    
                    <button <?php
                    if($this->status_check!=1){
                        echo "hidden";
                    }
                    ?> type="button" class="btn btn-danger" wire:click="cancelSupportRequest({{$this->ITSupportServicesRequestID}})"><i class="fas fa-times"></i> Cancel this request</button>
                    
                    @if($this->status_check!=3&&$this->status_check!=5)
                        <button type="button" class="btn btn-danger" wire:click="cancelWorkTicketIR({{$this->ITSupportServicesRequestID}})"><i class="fas fa-times"></i> Set Cancel</button>
                    @endif
                </div>
                @if($this->status_check==3)
                    <p><strong>Remarks: </strong>{{ $this->cancel_reason ?? "none" }}</p>
                @endif
            </div>
        </form>
    </div>
</div>