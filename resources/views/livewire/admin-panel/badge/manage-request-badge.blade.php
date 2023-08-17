
@foreach($count_technical_request as $count)
@if($count->status_id==1)
    <?php
        $this->total++;
    ?>
@endif
@endforeach

@foreach($count_support_request as $count)
@if($count->status_id==1)
    <?php
        $this->total++;
    ?>
@endif
@endforeach

@foreach($count_borrow_request as $count)
@if($count->status_id==1)
    <?php
        $this->total++;
    ?>
@endif
@endforeach
@if($this->total!=0)
    <span class="right badge badge-secondary">
        {{ $this->total }}
    </span>
@endif
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
</div>
