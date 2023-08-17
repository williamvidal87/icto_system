
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
    
</div>
