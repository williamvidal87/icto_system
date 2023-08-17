<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Inventory Report</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body"> 
                            <button type="button" class="btn btn-default"  wire:click="PrintInventoryToPDF"><i class="fas fa-print"></i> Print</button>
                            <table id="InventoryReportTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Device ID.</th>
                                        <th>Device Name</th>
                                        <th>Property No</th>
                                        <th>Serial No</th>
                                        <th hidden>Specs</th>
                                        <th hidden>Acquisition</th>
                                        <th>Date</th>
                                        <th>Client Assign</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Inventory_Equipment_Data as $data)
                                        <tr>
                                            <td>{{ "DE" }}{{ 1002039200+$data->id }}</td>
                                            <td>{{ $data->device_name }}</td>
                                            <td>{{ $data->property_no ?? "none" }}</td>
                                            <td>{{ $data->serial_no ?? "none" }}</td>
                                            <td hidden>{{ $data->specs ?? "none" }}</td>
                                            <td hidden><?php
                                                    
                                                $date=$data->created_at;
                                                $date = new DateTime($date);
                                                echo $date->format('d-m-Y');
                                                ?></td>
                                            <td><?php
                                                    
                                                $date=$data->updated_at;
                                                $date = new DateTime($date);
                                                echo $date->format('d/m/Y');
                                                ?></td>
                                            <td>{{ $data->getClient->name ?? "none" }}</td>
                                            <td>
                                                @if($data->status_id!=1)
                                                    @if($data->status_id==6)
                                                        <small class="badge badge-success">{{ $data->getStatus->status ?? " " }}</small>
                                                    @endif
                                                    @if($data->status_id==7)
                                                        <small class="badge badge-danger">{{ $data->getStatus->status ?? " " }}</small>
                                                    @endif
                                                    @if($data->status_id==8)
                                                        <small class="badge badge-warning">{{ $data->getStatus->status ?? " " }}</small>
                                                    @endif
                                                @endif
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
</div>
@section('custom_script')
    @include('layouts.scripts.admin-inventory-report-scripts'); 
@endsection