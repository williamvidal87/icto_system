<div>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">IT Support Service Request</h3>
          <button type="button" class="close" wire:click="closeITSupportServicesRequestForm" id="button-reset">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
          <div class="card-body">



            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label for="person_incharge">Person In-Charge</label>
                  <input type="text" class="form-control" id="person_incharge" wire:model="person_incharge" required>
                  @error('person_incharge') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="event_information">Event Information</label>
                  <input type="text" class="form-control" id="event_information" wire:model="event_information" required>
                  @error('event_information') <span class="error" style="color: red">{{ $message }}</span> @enderror
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="schedule">Set Schedule (<small>Optional</small>)</label>
                  <input type="datetime-local" class="form-control" id="schedule" name="schedule" wire:model="schedule">
                  @error('schedule') <span class="error">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                </div>
              </div>
            </div>

            <br>
            <div class="form-group">
                {{-- sample --}}
                
                <label>Services Needed</label>
                <table class="table" id="products_table">
                  <thead>
                      <tr>
                          <th width="40%">Type of Service</th>
                          <th width="40%">Description</th>
                          <th width="20%">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($orderProducts as $index => $orderProduct)
                      <tr>
                          <td>
                              <select name="orderProducts[{{$index}}][item_id]"
                                  wire:model="orderProducts.{{$index}}.item_id"
                                  class="form-control" required>
                                  <option value="">-- choose Service --</option>
                                  @foreach ($select_items as $product)
                                  <option value="{{ $product->id }}">{{ $product->equipment_name }}</option>
                                  @endforeach
                              </select>
                          </td>
                          <td>
                            <select name="orderProducts[{{$index}}][itemdes_id]"
                            wire:model="orderProducts.{{$index}}.itemdes_id"
                            class="form-control" required>
                            <option value="">-- choose Description --</option>
                            @foreach ($select_des as $product2)
                              @if ($this->orderProducts[$index]['item_id']==$product2->equipment_type_id)
                                @if ($product2->status_id==6)
                                <option <?php
                                          for ($i=0; $i < count($this->orderProducts); $i++) {
                                            if(!empty($this->orderProducts[$i]['itemdes_id'])){
                                              if ($product2->id == $this->orderProducts[$i]['itemdes_id']) {
                                                if ($this->orderProducts[$index]['itemdes_id'] == $this->orderProducts[$i]['itemdes_id']) {
                                                        // echo "none";
                                                } else {
                                                    echo "disabled";
                                                  }
                                              }
                                            }
                                            }
                                ?> value="{{ $product2->id }}">{{ $product2->description }}<?php
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
                                ?></option>
                                @endif
                              @endif
                            @endforeach
                        </select>
                          </td>
                          <td>
                              <button wire:click.prevent="removeProduct({{$index}})" class="py-0 btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="row">
                  <div class="col-md-12">
                      <button class="btn btn-sm btn-primary" wire:click.prevent="addProduct">+ Add Services</button>
                  </div>
              </div>
                {{-- end sample --}}
            </div>
            <label for="problem"><h3 class="card-title"><strong>Upload Letter</strong> </h3>(<small>Optional</small>)</label>
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
                <button type="button" class="btn btn-default" wire:click="closeITSupportServicesRequestForm">Close</button>
                @if(!empty($this->ITSupportServicesRequestID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
      </div>
  </div>