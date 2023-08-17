<div>
    <section class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1>Technical Request</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
  
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body" style="font-size: 11pt">
                  <table id="TechnicalRequestTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Request No.</th>
                      <th data-toggle="tooltip" data-placement="top" title="End-User/Office Info">End-User</th>
                      <th>Client</th>
                      <th>Problem</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($Client_Technical_Request_Database as $data)
                        <tr>
                          <td><u><a href="javascript: void(0)" wire:click="openTechnicalView({{$data->id}})">{{ "TR" }}{{ 3300+$data->id }}</a></u></td>
                          <td>{{ $data->user_office_info }}</td>
                          <td>{{ $data->getClientID->name }}</td>
                          <td>{{ $data->problem }}</td>
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
                              <button  class="py-0 btn btn-sm btn-info" wire:click="editTechnicalRequest({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                              <button  class="py-0 btn btn-sm btn-secondary" wire:click="openTechnicalView({{$data->id}})"><i class="fas fa-eye"></i>Review</button>
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
      
      
          <!-- CREATE EDIT MODAL -->
      <div wire.ignore.self class="modal fade" id="TechnicalRequestModal" role="dialog" aria-labelledby="TechnicalRequestModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <livewire:client-panel.request-tech-services.technical-form />
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      <!-- VIEW MODAL -->
      <div wire.ignore.self class="modal fade" id="TechnicalRequestView" role="dialog" aria-labelledby="TechnicalRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <livewire:admin-panel.manage-request.technical-request-view />
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    
      <!-- Cancel Confirm Modal -->
      <div wire.ignore.self id="cancel_data" class="modal fade" role="dialog" aria-labelledby="cancel_data" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-confirm">
          <livewire:cancel-data.cancel />
        </div>
      </div>
  
  </div>
  @section('custom_script')
    @include('layouts.scripts.client-technical-request-scripts'); 
  @endsection