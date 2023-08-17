
@push('technical-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        window.initPersonnel_idDrop = () => {
            $('#personnel_id').select2({
                dropdownParent: $("#TechnicalRequestView"),
                placeholder: 'Select a Personnel',
                allowClear: false,
                closeOnSelect: true,
                theme: 'bootstrap4'

            });
        }

        initPersonnel_idDrop();
        $('#personnel_id').on('change', function(e) {
            livewire.emit('selectedPersonnel', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initPersonnel_idDrop();
        });
        
        $(function () {
                    $("#TechnicalRequestTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#TechnicalRequestTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })
    
    window.livewire.on('openTechnicalRequestModal', () => {
            $('#TechnicalRequestModal').modal('show');
    });
    
    window.livewire.on('openTechnicalRequestView', () => {
            $('#TechnicalRequestView').modal('show');
    });
    
    window.livewire.on('closeTechnicalRequestModal', () => {
            $('#TechnicalRequestModal').modal('hide');
            if ($.fn.DataTable.isDataTable("#TechnicalRequestTable")) {
                $('#TechnicalRequestTable').DataTable().destroy();
                }
                else{
                    $("#TechnicalRequestTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#TechnicalRequestTable_wrapper .col-md-6:eq(0)');
                }
                
    });
    
    window.livewire.on('closeTechnicalRequestView', () => {
            $('#TechnicalRequestView').modal('hide');
            if ($.fn.DataTable.isDataTable("#TechnicalRequestTable")) {
                $('#TechnicalRequestTable').DataTable().destroy();
                }
                else{
                    $("#TechnicalRequestTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#TechnicalRequestTable_wrapper .col-md-6:eq(0)');
                }
                
    });

    window.livewire.on('openDeleteConfirmTechnicalRequestModal', () => {

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
                    if ($.fn.DataTable.isDataTable("#TechnicalRequestTable")) {
                                $('#TechnicalRequestTable').DataTable().destroy();
                            }
                    $("#TechnicalRequestTable").DataTable({
                    order: [[0, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#TechnicalRequestTable_wrapper .col-md-6:eq(0)');
                
                
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
            title: 'Technical Request Successfully Save.'
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
            title: 'Technical Request Successfully Updated.'
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
            title: 'Technical Request Successfully Deleted.'
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