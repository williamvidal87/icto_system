
@push('equipment-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        $(function () {
                    $("#EquipmentTable").DataTable({
                        order: [[0, 'desc']],
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#EquipmentTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })
    
    window.livewire.on('openServicesEquipmentModal', () => {
            $('#ServicesEquipemntModal').modal('show');
    });
    
    window.livewire.on('openServicesEquipemntView', () => {
            $('#ServicesEquipemntView').modal('show');
    });
    
    window.livewire.on('closeServicesEquipmentModal', () => {
            $('#ServicesEquipemntModal').modal('hide');
            if ($.fn.DataTable.isDataTable("#EquipmentTable")) {
                    $('#EquipmentTable').DataTable().destroy();
                }
                else{
                    $("#EquipmentTable").DataTable({
                        order: [[0, 'desc']],
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#EquipmentTable_wrapper .col-md-6:eq(0)');
                }
                
    });
    
    window.livewire.on('closeServicesEquipmentView', () => {
            $('#ServicesEquipemntView').modal('hide');
            if ($.fn.DataTable.isDataTable("#EquipmentTable")) {
                    $('#EquipmentTable').DataTable().destroy();
                }
                else{
                    $("#EquipmentTable").DataTable({
                        order: [[0, 'desc']],
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#EquipmentTable_wrapper .col-md-6:eq(0)');
                }
                
    });

    window.livewire.on('openDeleteConfirmServicesEquipemntModal', () => {

            $('#delete_data').modal('show');
    });

    window.livewire.on('closeDeleteConfirmModal', () => {

            $('#delete_data').modal('hide');
    });

    window.livewire.on('openCancelConfirmModal', () => {

            $('#cancel_data').modal('show');
    });

    window.livewire.on('closeCancelConfirmModal', () => {

            $('#cancel_data').modal('hide');
    });


    window.livewire.on('EmitTable', () => {
                    if ($.fn.DataTable.isDataTable("#EquipmentTable")) {
                                $('#EquipmentTable').DataTable().destroy();
                                }
                    $("#EquipmentTable").DataTable({
                        order: [[0, 'desc']],
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#EquipmentTable_wrapper .col-md-6:eq(0)');
                
                
    });

    // for store alert
    window.livewire.on('alert_store', () => {
        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000
            });
            Toast.fire({
            icon: 'success',
            title: 'Services Equipment Successfully Save.'
            })
        });
    });
    // for update alert
    window.livewire.on('alert_update', () => {
        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000
            });
            Toast.fire({
            icon: 'info',
            title: 'Services Equipment Successfully Updated.'
            })
        });
    });
    // for delete alert
    window.livewire.on('alert_delete', () => {
        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000
            });
            Toast.fire({
            icon: 'error',
            title: 'Services Equipment Successfully Deleted.'
            })
        });
    });
    // for warning alert
    window.livewire.on('alert_warning', () => {
        $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000
            });
            Toast.fire({
            icon: 'warning',
            title: 'You are not allowed to update this record right now.'
            })
        });
    });
</script>
@endpush