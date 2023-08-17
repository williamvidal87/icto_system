
@push('inventory-report-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        
        $(function () {
                    $("#InventoryReportTable").DataTable({
                    order: [[6, 'desc']],
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#InventoryReportTable_wrapper .col-md-6:eq(0)');
                
                
            });
            
    window.livewire.on('EmitTable', () => {
                    if ($.fn.DataTable.isDataTable("#InventoryReportTable")) {
                                $('#InventoryReportTable').DataTable().destroy();
                    }
                    $("#InventoryReportTable").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#AdminTable_wrapper .col-md-6:eq(0)');
                
                
    });
                
        
    })
</script>
@endpush