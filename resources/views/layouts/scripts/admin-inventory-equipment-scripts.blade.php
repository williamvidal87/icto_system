
@push('inventory-equipment-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        $(function () {
                    $("#InventoryEquipmentTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#InventoryEquipmentTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })
    
    window.livewire.on('openInventoryEquipmentModal', () => {
            $('#InventoryEquipmentModal').modal('show');
    });
    
    window.livewire.on('openInventoryEquipmentView', () => {
            $('#InventoryEquipmentView').modal('show');
    });
    
    window.livewire.on('closeInventoryEquipmentModal', () => {
            $('#InventoryEquipmentModal').modal('hide');
            if ($.fn.DataTable.isDataTable("#InventoryEquipmentTable")) {
                $('#InventoryEquipmentTable').DataTable().destroy();
                }
                else{
                    $("#InventoryEquipmentTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#InventoryEquipmentTable_wrapper .col-md-6:eq(0)');
                }
                
    });
    
    window.livewire.on('closeInventoryEquipmentView', () => {
            $('#InventoryEquipmentView').modal('hide');
            if ($.fn.DataTable.isDataTable("#InventoryEquipmentTable")) {
                $('#InventoryEquipmentTable').DataTable().destroy();
                }
                else{
                    $("#InventoryEquipmentTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#InventoryEquipmentTable_wrapper .col-md-6:eq(0)');
                }
                
    });

    window.livewire.on('openDeleteConfirmInventoryEquipmentModal', () => {

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
                    if ($.fn.DataTable.isDataTable("#InventoryEquipmentTable")) {
                                $('#InventoryEquipmentTable').DataTable().destroy();
                            }
                    $("#InventoryEquipmentTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#InventoryEquipmentTable_wrapper .col-md-6:eq(0)');
                
                
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
            title: 'Inventory Equipment Successfully Save.'
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
            title: 'Inventory Equipment Successfully Updated.'
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
            title: 'Inventory Equipment Successfully Deleted.'
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