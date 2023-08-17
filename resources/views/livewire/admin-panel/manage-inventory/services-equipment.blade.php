<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Services</h1>
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
                            <button style="width: 10rem" type="button" class="btn btn-block bg-gradient-primary"  wire:click="createServicesEquipment"><i class="fa fa-plus-circle"></i> Add Services</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="EquipmentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th data-toggle="tooltip" data-placement="top" title="Type of Service">Type of Service</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Equipments as $data)
                                    <tr>    
                                            <td><u><a href="javascript: void(0)" wire:click="openServicesEquipment({{$data->id}})">{{ 400+$data->id }}</a></u></td>
                                            <td>{{ $data->getEquipementType->equipment_name ?? " " }}</td>
                                            <td>{{ $data->description }}</td>
                                            <td>
                                                @if($data->status_id==6)
                                                    <small class="badge badge-success">{{ $data->getStatus->status ?? " " }}</small>
                                                @endif
                                                @if($data->status_id==11)
                                                    <small class="badge badge-danger">{{ $data->getStatus->status ?? " " }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>
                                                <button button  class="py-0 btn btn-sm btn-info" wire:click="editServicesEquipment({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                                <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteServicesEquipment({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button> |
                                                <button  class="py-0 btn btn-sm btn-secondary" wire:click="openServicesEquipment({{$data->id}})"><i class="fas fa-eye"></i>View</button>
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
    
    <!-- CREATE EDIT MODAL -->
    <div wire.ignore.self class="modal fade" id="ServicesEquipemntModal" role="dialog" aria-labelledby="ServicesEquipemntModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <livewire:admin-panel.manage-inventory.services-equipment-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <!-- VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="ServicesEquipemntView" role="dialog" aria-labelledby="ServicesEquipemntView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <livewire:admin-panel.manage-inventory.services-equipment-view />
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
    @include('layouts.scripts.admin-services-equipment-scripts')
@endsection