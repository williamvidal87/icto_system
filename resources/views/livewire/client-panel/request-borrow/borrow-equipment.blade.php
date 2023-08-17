<div>
    <section class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1>Borrow Equipment Request</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
  
              <div class="card">
              <br>
                <div style="margin-left: 1rem">
                    <button style="width: 9rem" type="button" class="btn btn-block bg-gradient-primary"  wire:click="createBorrowEquipmentRequest"><i class="fa fa-plus-circle"></i> Add Request</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="font-size: 11pt">
                  <table id="BorrowEquipmentRequestTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Request No.</th>
                      <th>End-User/Office Info</th>
                      <th>Equipment to borrow</th>
                      <th>Purpose</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($Client_Borrow_Equipment_Request_Database as $data)
                        <tr>
                          <td><u><a wire:click="openBorrowEquipmentRequestView({{$data->id}})" href="javascript: void(0)">{{ "BR" }}{{ 2200+$data->id }}</a></u></td>
                          <td>{{ $data->user_office_info }}</td>
                          <td>
                            @foreach ($UsedEquipments as $data2)
                            @if ($data2->used_id==$data->id)
                            {{ $data2->getItemName->device_name }},
                            @endif
                            @endforeach
                          </td>
                          <td>{{ $data->purpose }}</td>
                          @if($data->status_id!=1)
                          <td>
                            @if($data->status_id==2)
                              <small class="badge badge-success">{{ $data->getStatus->status ?? " " }}</small>
                            @endif
                            @if($data->status_id==3)
                              <small class="badge badge-danger">{{ $data->getStatus->status ?? " " }}</small>
                            @endif
                            @if($data->status_id==4)
                              <small class="badge badge-warning">{{ $data->getStatus->status ?? " " }}</small>
                            @endif
                            @if($data->status_id==5)
                              <small class="badge badge-light">{{ $data->getStatus->status ?? " " }}</small>
                            @endif
                          </td>
                          <td>
                          </td>
                        @else
                          <td>
                            <small class="badge badge-secondary">{{ $data->getStatus->status ?? " " }}</small>
                          </td>
                          <td>
                            <button  class="py-0 btn btn-sm btn-info" wire:click="editBorrowEquipmentRequest({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                            <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteBorrowEquipmentRequest({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
                          </td>
                        @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      
      <div wire.ignore.self class="modal fade" id="BorrowEquipmentRequestModal" role="dialog" aria-labelledby="BorrowEquipmentRequestModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <livewire:client-panel.request-borrow.borrow-equipment-form />
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      <div wire.ignore.self class="modal fade" id="BorrowEquipmentRequestView" role="dialog" aria-labelledby="BorrowEquipmentRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <livewire:client-panel.request-borrow.borrow-equipment-view />
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      <!-- Delete Confirm Modal -->
      <div wire.ignore.self id="delete_data" class="modal fade" role="dialog" aria-labelledby="delete_data" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-confirm">
          <livewire:delete-data.delete />
        </div>
      </div>
  
  </div>
  @section('custom_script')
    @include('layouts.scripts.client-borrow-equipment-request-scripts'); 
  @endsection