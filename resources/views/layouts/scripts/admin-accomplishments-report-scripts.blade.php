
@push('accomplishments-report-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        $(function () {
                    $("#WorkTicketTable").DataTable({
                    order: [[6, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#WorkTicketTable_wrapper .col-md-6:eq(0)');
                
                
            });
            
            window.livewire.on('EmitTable', () => {
                            if ($.fn.DataTable.isDataTable("#WorkTicketTable")) {
                                        $('#WorkTicketTable').DataTable().destroy();
                            }
                            $("#WorkTicketTable").DataTable({
                            "responsive": true, "lengthChange": false, "autoWidth": false,
                            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                            }).buttons().container().appendTo('#AdminTable_wrapper .col-md-6:eq(0)');
                        
                        
            });
                
        
    })
</script>
@endpush