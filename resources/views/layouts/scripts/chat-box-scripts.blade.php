@push('chat-box-scripts')
<script type="text/javascript">
    window.livewire.on('openchatboxmodal', () => {
        $('#chatboxform').modal('show');
    });
    window.livewire.on('closechatboxmodal', () => {
        $('#chatboxform').modal('hide');
    });
    var divsample = $(".listing-item");
    divsample.sort(function(a, b){ return $(b).data("listing-price")-$(a).data("listing-price")});
    
    $("#myUL").html(divsample);
</script>
@endpush