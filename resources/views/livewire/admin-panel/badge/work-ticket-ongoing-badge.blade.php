
@foreach($count_work_ticket_ongoing as $count)
@if($count->status_id==4)
    <?php
        $this->total++;
    ?>
@endif
@endforeach
@if($this->total!=0)
    <span class="right badge badge-warning">
        {{ $this->total }}
    </span>
@endif

<div>
    {{-- The whole world belongs to you. --}}
</div>
