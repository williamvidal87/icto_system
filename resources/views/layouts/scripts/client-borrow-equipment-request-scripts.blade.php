
@push('borrow-equipment-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
      window.initPersonnel_idDrop = () => {
            $('#personnel_id').select2({
                dropdownParent: $("#BorrowEquipmentRequestView"),
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
                    $("#BorrowEquipmentRequestTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#BorrowEquipmentRequestTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })
    
    window.livewire.on('openBorrowEquipmentRequestModal', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestModal').modal('show');
    });
    
    window.livewire.on('openBorrowEquipmentRequestView', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestView').modal('show');
    });
    
    window.livewire.on('closeBorrowEquipmentRequestModal', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestModal').modal('hide');
            if ($.fn.DataTable.isDataTable("#BorrowEquipmentRequestTable")) {
                  $('#BorrowEquipmentRequestTable').DataTable().destroy();
                }
                else{
                    $("#BorrowEquipmentRequestTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#BorrowEquipmentRequestTable_wrapper .col-md-6:eq(0)');
                }
                
    });
    
    window.livewire.on('closeBorrowEquipmentRequestView', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestView').modal('hide');
            if ($.fn.DataTable.isDataTable("#BorrowEquipmentRequestTable")) {
                  $('#BorrowEquipmentRequestTable').DataTable().destroy();
                }
                else{
                    $("#BorrowEquipmentRequestTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#BorrowEquipmentRequestTable_wrapper .col-md-6:eq(0)');
                }
                
    });

    window.livewire.on('openDeleteConfirmBorrowEquipmentRequestModal', () => {

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
                    if ($.fn.DataTable.isDataTable("#BorrowEquipmentRequestTable")) {
                                $('#BorrowEquipmentRequestTable').DataTable().destroy();
                              }
                    $("#BorrowEquipmentRequestTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#BorrowEquipmentRequestTable_wrapper .col-md-6:eq(0)');
                
                
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
            title: 'Borrow Equipment Request Successfully Save.'
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
            title: 'Borrow Equipment Request Successfully Updated.'
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
            title: 'Borrow Equipment Request Successfully Deleted.'
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