
@push('activity-log-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        $(function () {
                    $("#ActivityLogTable").DataTable({
                      order: [[1, 'desc']],
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#ActivityLogTable_wrapper .col-md-6:eq(0)');
                
                
            });
                
        
    })

</script>
@endpush