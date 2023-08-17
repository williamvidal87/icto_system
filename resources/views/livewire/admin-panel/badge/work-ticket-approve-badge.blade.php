
@foreach($count_work_ticket_approve as $count)
@if($count->status_id==2)
    <?php
        $this->total++;
    ?>
@endif
@endforeach
@if($this->total!=0)
    <span class="right badge badge-success" style="margin-right: 1.8rem">
        {{ $this->total }}
    </span>
@endif

<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
