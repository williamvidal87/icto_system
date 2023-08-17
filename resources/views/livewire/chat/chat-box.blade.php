<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge"><?php
                if ($this->message_count==0) {
                    # none
                }else {
                    echo $this->message_count;
                }
            ?></span>
        </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" autocomplete="off">
                </span>
                <div style= "height: 600px; overflow-y: scroll;">
                    <ul id="myUL">
                    
                    
                    
                    
                        @foreach ($all_names as $name)
                            <div>
                                <div class="dropdown-divider"></div>
                            <li style="<?php
                            $notseen=false;
                            foreach ($messages_status as $message_status) {
                                if ($name->id==$message_status->from_id) {
                                    if($message_status->status_id==10||$message_status->status_id==null&&$name->id!=Auth::user()->id) {
                                        $notseen=true;
                                    }
                                }
                            }
                            if ($notseen==true) {
                                echo "background-color: #e1e6ed";
                            }
                        ?>" class="listing-item" data-listing-price="<?php
                            $this->temptime='';
                            foreach ($last_message as $lastmessage) {
                                if (($name->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->to_id&&$name->id==$lastmessage->from_id)) {
                                    $this->temptime=$lastmessage->created_at;
                                }
                            }
                                if ($this->temptime!='') {
                                echo $this->temptime->format('Y');
                                echo $this->temptime->format('m');
                                echo $this->temptime->format('d');
                                echo $this->temptime->format('H');
                                echo $this->temptime->format('i');
                                echo $this->temptime->format('s');
                                }
                            ?>">
                                <a href="javascript: void(0)" class="dropdown-item" wire:click="openChatForm({{$name->id}})">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="/storage/{{ $name->profile_photo_path ?? 'default-profile/admin-profile.png' }}" alt="User Avatar" class="rounded-full h-12 w-12 object-cover">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                {{ $name->name }}
                                            </h3>
                                            <p class="text-sm">
                                                <?php
                                                $this->tempmessage='';
                                                foreach ($last_message as $lastmessage) {
                                                    if (($name->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->to_id&&$name->id==$lastmessage->from_id)) {
                                                        $this->tempmessage=$lastmessage->message;
                                                    }
                                                }
                                                    echo $this->tempmessage;
                                                ?>
                                            </p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                                <?php
                                                $this->temptime='';
                                                foreach ($last_message as $lastmessage) {
                                                    if (($name->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->from_id&&$name->id==$lastmessage->to_id)||(Auth::user()->id==$lastmessage->to_id&&$name->id==$lastmessage->from_id)) {
                                                        $this->temptime=$lastmessage->created_at;
                                                    }
                                                }
                                                if ($this->temptime!='') {
                                                    echo $this->temptime->format('d M Y g:i a');
                                                    // echo $this->temptime->format('Y');
                                                    // echo $this->temptime->format('m');
                                                    // echo $this->temptime->format('H');
                                                    // echo $this->temptime->format('i');
                                                    // echo $this->temptime->format('s');
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            </li>
                    </div>

                    @endforeach

                    
                    
                
                    </ul>
                </div>

            </div>
    </li>
</div>
@section('custom_script')
@include('layouts.scripts.chat-box-scripts'); 
@endsection