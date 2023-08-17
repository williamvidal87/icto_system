<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1>Service Type</h1>
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
                            <button style="width: 11rem" type="button" class="btn btn-block bg-gradient-primary"  wire:click="createServiceType"><i class="fa fa-plus-circle"></i> Add Service Type</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="ServiceTypeTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Service Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ServiceTypeData as $data)
                                        <tr>
                                            <td>{{ 200+$data->id }}</td>
                                            <td>{{ $data->equipment_name }}</td>
                                            <td>
                                                <button  class="py-0 btn btn-sm btn-info" wire:click="editServiceType({{$data->id}})"><i class="fas fa-edit"></i>Edit</button> | 
                                                <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteServiceType({{$data->id}})"><i class="fas fa-trash-alt"></i>Delete</button>
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
    <div wire.ignore.self class="modal fade" id="ServiceTypeModal" role="dialog" aria-labelledby="ServiceTypeModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <livewire:admin-panel.extra.service-type-form />
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
    @include('layouts.scripts.admin-service-type-scripts'); 
@endsection