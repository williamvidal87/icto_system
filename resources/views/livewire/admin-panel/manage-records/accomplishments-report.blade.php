<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Accomplishments Report</h1>
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
                        <div class="card-body">
                            <button type="button" class="btn btn-default"  wire:click="PrintAccomplishmentToPDF"><i class="fas fa-print"></i> Print</button>
                            <table id="WorkTicketTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th>Request</th>
                                        <th>Category</th>
                                        <th>Assign Personnel</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($WorkTicketDatabase as $data)
                                        <tr>
                                            <td>{{ "TK" }}{{ 11000+$data->id }}</td>
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
                                                    
                                                $date=$data->updated_at;
                                                $date = new DateTime($date);
                                                echo $date->format('d-m-Y');
                                                ?></td>
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

</div>
@section('custom_script')
    @include('layouts.scripts.admin-accomplishments-report-scripts'); 
@endsection