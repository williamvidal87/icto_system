
@push('work-ticket-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
      // window.initPersonnel_idDrop = () => {
      //       $('#personal_id_br').select2({
      //           dropdownParent: $("#BorrowEquipmentRequestView"),
      //           placeholder: 'Select a Personnel',
      //           allowClear: false,
      //           closeOnSelect: true,
      //           theme: 'bootstrap4'

      //       });
      //   }

      //   initPersonnel_idDrop();
      //   $('#personal_id_br').on('change', function(e) {
      //       livewire.emit('selectedPersonnel', e.target.value)
      //   });
        
      //   window.livewire.on('select2', () => {
      //       initPersonnel_idDrop();
      //   });
        
        $(function () {
                    $("#WorkTicketTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#WorkTicketTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })
    
    
    window.livewire.on('openTechnicalRequestView', () => {
            $('#TechnicalRequestView').modal('show');
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
    
    window.livewire.on('openITSupportServicesRequestView', () => {
            $('#ITSupportServicesRequestView').modal('show');
    });
    
    window.livewire.on('closeITSupportServicesRequestView', () => {
            $('#ITSupportServicesRequestView').modal('hide');
            if ($.fn.DataTable.isDataTable("#ITSupportServicesRequestTable")) {
                  $('#ITSupportServicesRequestTable').DataTable().destroy();
                }
                else{
                    $("#ITSupportServicesRequestTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#ITSupportServicesRequestTable_wrapper .col-md-6:eq(0)');
                }
                
    });
    
    window.livewire.on('openBorrowEquipmentRequestView', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestView').modal('show');
    });
    
    window.livewire.on('closeBorrowEquipmentRequestView', () => {
        // alert("gana");
            $('#BorrowEquipmentRequestView').modal('hide');
            if ($.fn.DataTable.isDataTable("#WorkTicketTable")) {
                  $('#WorkTicketTable').DataTable().destroy();
                }
                else{
                    $("#WorkTicketTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#WorkTicketTable_wrapper .col-md-6:eq(0)');
                }
                
    });

    window.livewire.on('openCancelConfirmModal', () => {

            $('#cancel_data').modal('show');
    });

    window.livewire.on('closeCancelConfirmModal', () => {

            $('#cancel_data').modal('hide');
    });


    window.livewire.on('EmitTable', () => {
                    if ($.fn.DataTable.isDataTable("#WorkTicketTable")) {
                                $('#WorkTicketTable').DataTable().destroy();
                              }
                    $("#WorkTicketTable").DataTable({
                      order: [[0, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#WorkTicketTable_wrapper .col-md-6:eq(0)');
                
                
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
    // window.livewire.on('alert_update', () => {
    //     $(function() {
    //       var Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-end',
    //         showConfirmButton: false,
    //         timer: 6000
    //       });
    //         Toast.fire({
    //         icon: 'info',
    //         title: 'Borrow Equipment Request Successfully Updated.'
    //         })
    //     });
    // });
    // for cancel alert
    window.livewire.on('alert_cancel', () => {
        $(function() {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000
          });
            Toast.fire({
            icon: 'error',
            title: 'Work Ticket Successfully Cancelled.'
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