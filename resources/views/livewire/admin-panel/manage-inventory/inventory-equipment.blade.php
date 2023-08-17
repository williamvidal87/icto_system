<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Inventory Equipment</h1>
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
                            <button style="width: 14.5rem" type="button" class="btn btn-block bg-gradient-primary"  wire:click="createInventoryEquipment"><i class="fa fa-plus-circle"></i> Add Inventory Equipment</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="InventoryEquipmentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Device ID.</th>
                                        <th>Device Name</th>
                                        <th>Client Assign</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Inventory_Equipment_Data as $data)
                                        <tr>
                                            <td><u><a href="javascript: void(0)" wire:click="openInventoryView({{$data->id}})">{{ "DE" }}{{ 1002039200+$data->id }}</a></u></td>
                                            <td>{{ $data->device_name }}</td>
                                            <td>{{ $data->getClient->name ?? " " }}</td>
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
                                            <td>
                                                <button  class="py-0 btn btn-sm btn-info" wire:click="editInventoryEquipment({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                                <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteInventoryEquipment({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button> |
                                                <button  class="py-0 btn btn-sm btn-secondary" wire:click="openInventoryView({{$data->id}})"><i class="fas fa-eye"></i>View</button>
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
    <div wire.ignore.self class="modal fade" id="InventoryEquipmentModal" role="dialog" aria-labelledby="InventoryEquipmentModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-inventory.inventory-equipment-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <!-- VIEW MODAL -->
    <div wire.ignore.self class="modal fade" id="InventoryEquipmentView" role="dialog" aria-labelledby="InventoryEquipmentView" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-inventory.inventory-equipment-view />
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
    @include('layouts.scripts.admin-inventory-equipment-scripts'); 
@endsection