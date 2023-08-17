<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Work Tickets</h1>
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
                            <table id="WorkTicketTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Ticket No.</th>
                                        <th>Request No.</th>
                                        <th>Category</th>
                                        <th>Assign Personnel</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Date Aprrove</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($WorkTicketDatabase as $data)
                                        <tr>
                                            <td><u><a wire:click="openWorkTicketView({{$data->id}},{{$data->request_category}},{{$data->technical_id ?? $data->support_id ?? $data->borrow_id}})" href="javascript: void(0)">{{ "TK" }}{{ 11000+$data->id }}</a></u></td>
                                            <td>
                                                @if(!empty($data->technical_id))
                                                    {{ "TR" }}{{ 3300+$data->getTechnicalID->id }}
                                                @endif
                                                @if(!empty($data->support_id))
                                                    {{ "IR" }}{{ 6600+$data->getSupportID->id }}
                                                @endif
                                                @if(!empty($data->borrow_id))
                                                    {{ "BR" }}{{ 2200+$data->getBorrowID->id }}
                                                @endif
                                            </td>
                                            <td>{{ $data->getRequestCategory->request_type ?? " " }}</td>
                                            <td>
                                                @if(!empty($data->technical_id))
                                                    {{ $data->getTechnicalPersonnelID->getPersonnelID->name }}
                                                @endif
                                                @if(!empty($data->support_id))
                                                    {{ $data->getSupportPersonnelID->getPersonnelID->name }}
                                                @endif
                                                @if(!empty($data->borrow_id))
                                                    {{ $data->getBorrowPersonnelID->getPersonnelID->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($data->technical_id))
                                                    {{ $data->getTechnicalClientID->getClientID->name }}
                                                @endif
                                                @if(!empty($data->support_id))
                                                    {{ $data->getSupportClientID->getClientID->name }}
                                                @endif
                                                @if(!empty($data->borrow_id))
                                                    {{ $data->getBorrowClientID->getClientID->name }}
                                                @endif
                                            </td>
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
                                                
                                                <td><?php
                                                    
                                                $date=$data->date_approve;
                                                $date = new DateTime($date);
                                                echo $date->format('d/m/Y');
                                                ?></td>
                                                <td style="width: 4.79rem">
                                                    <button  class="py-0 btn btn-sm btn-secondary" wire:click="openWorkTicketView({{$data->id}},{{$data->request_category}},{{$data->technical_id ?? $data->support_id ?? $data->borrow_id}})"><i class="fas fa-eye"></i>Review</button>
                                                </td>
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
    
    <!-- TECHNICAL VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="TechnicalRequestView" role="dialog" aria-labelledby="TechnicalRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-request.technical-request-view />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
    <!-- SUPPORT VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="ITSupportServicesRequestView" role="dialog" aria-labelledby="ITSupportServicesRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-request.support-request-view />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
    <!-- BORROW VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="BorrowEquipmentRequestView" role="dialog" aria-labelledby="BorrowEquipmentRequestView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-request.borrow-request-view />
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
    @include('layouts.scripts.admin-work-ticket-scripts'); 
@endsection