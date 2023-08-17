<div>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Technical Request</h3>
          <button type="button" class="close" wire:click="closeTechnicalRequestView" id="button-reset">
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
                  <label for="work_ticket">Request No.</label>
                  <input type="text" class="form-control" id="work_ticket" wire:model="work_ticket" disabled>
                </div>
                <div class="form-group">
                  <label for="user_office_info">End-User</label>
                  <input type="text" class="form-control" id="user_office_info" wire:model="user_office_info" disabled>
                </div>
                <div class="form-group">
                    <label for="problem">Problem </label>
                    <input type="text" class="form-control" id="problem" wire:model="problem" disabled>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="status_id">Status </label>
                    <input type="text" class="form-control" id="status_id" wire:model="status_id" disabled>
                </div>
                
                <div class="form-group">
                          Photo Preview:
                          @foreach ($this->images as $image)
                          @endforeach
                      <div class="row" style="height: 150px; overflow-y: scroll;">
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
                        <div class="row" style="height: 150px; overflow-y: scroll;">
                          @foreach ($this->letters as $letter)
                            <div class="mb-1 col-3 card me-1" style="height: 150px;">
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
                  </div>
                </div>
                
                
              </div>
              
            </div>
          </div>
          <!-- /.card-body -->
  
          
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" wire:click="closeTechnicalRequestView">Close</button>
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
                  ?> type="button" class="btn btn-danger" wire:click="cancelTechnicalRequest({{$this->TechnicalRequestID}})"><i class="fas fa-times"></i> Cancel this request</button>
                @if($this->status_check!=3&&$this->status_check!=5)
                  <button type="button" class="btn btn-danger" wire:click="cancelWorkTicketTR({{$this->TechnicalRequestID}})"><i class="fas fa-times"></i> Set Cancel</button>
                @endif
              </div>
              @if($this->status_check==3)
                <p><strong>Remarks: </strong>{{ $this->cancel_reason ?? "none" }}</p>
              @endif
            </div>
        </form>
    </div>
</div>