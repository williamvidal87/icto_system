<div>
    <section class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1>IT Support Service Request</h1>
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
                    <button style="width: 9rem" type="button" class="btn btn-block bg-gradient-primary"  wire:click="createITSupportServicesRequest"><i class="fa fa-plus-circle"></i> Add Request</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="font-size: 11pt">
                  <table id="ITSupportServicesRequestTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Request No.</th>
                      <th>Person In-Charge</th>
                      <th>Event Information</th>
                      <th>Schedule</th>
                      <th>Services Needed</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($Client_ITSupportServices_Request_Database as $data)
                        <tr>
                          <td><u><a href="javascript: void(0)" wire:click="openITSupportServicesRequestView({{$data->id}})">{{ "IR" }}{{ 6600+$data->id }}</a></u></td>
                          <td>{{ $data->person_incharge }}</td>
                          <td>{{ $data->event_information }}</td>
                          <td><?php
                            if(!empty($data->schedule)){
                            $date=$data->schedule;
                            $date = new DateTime($date);
                            echo $date->format('d/m/y h:i A');
                            }else {
                            }
                            ?></td>
                          <td>
                            @foreach ($UsedEquipments as $data2)
                              @if ($data2->used_id==$data->id)
                                @foreach ($equipmentdesc as $data3)
                                  @if ($data3->id==$data2->itemdes_id)
                                  {{ $data3->description }},
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          </td>
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
                            <button  class="py-0 btn btn-sm btn-info" wire:click="editITSupportServicesRequest({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                            <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteITSupportServicesRequest({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
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
      
      <div wire.ignore.self class="modal fade" id="ITSupportServicesRequestModal" role="dialog" aria-labelledby="ITSupportServicesRequestModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <livewire:client-panel.request-tech-services.i-t-support-services-form />
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      <div wire.ignore.self class="modal fade" id="ITSupportServicesRequestView" role="dialog" aria-labelledby="ITSupportServicesRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <livewire:client-panel.request-tech-services.i-t-support-services-view />
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
    @include('layouts.scripts.client-it-support-services-request-scripts'); 
  @endsection