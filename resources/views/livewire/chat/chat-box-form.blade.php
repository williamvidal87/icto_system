<div>
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header">
          <h3 class="card-title">Direct Chat</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="closeChatForm">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages" id="containerID">
          
            @foreach($all_messages as $message)
            @if($message->from_id==Auth::user()->id)
              <!-- Message to the right -->
              <div class="direct-chat-msg right" style="margin-left: auto; min-width: 30%">
                <div class="direct-chat-infos clearfix">
                  <span class="direct-chat-name float-right">{{  $message->getfromName->name}}</span>
                  <span class="direct-chat-timestamp float-left">{{ $message->created_at->format('d M Y g:i a') }}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="/storage/{{ $message->getfromName->profile_photo_path ?? 'default-profile/admin-profile.png' }}" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  <div class="dropdown">
                    <a class="" data-toggle="dropdown">
                      <div>
                        <div>
                          {{ $message->message }}
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu" style="padding-top: 0%; padding-bottom: 0%;">
                      <a class="dropdown-item" wire:click="deleteChatMessage({{$message->id}})" style="font-size: 80%;">Delete</a>
                    </div>
                  </div>
                </div>
                <!-- /.direct-chat-text -->
              </div>
            <!-- /.direct-chat-msg -->
            @else
              <!-- Message. Default to the left -->
            <div class="direct-chat-msg" style="margin-right: auto; min-width: 30%">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{  $message->getfromName->name}}</span>
                <span class="direct-chat-timestamp float-right">{{ $message->created_at->format('d M Y g:i a') }}</span>
              </div>
              <!-- /.direct-chat-infos -->
              <img class="direct-chat-img" src="/storage/{{ $message->getfromName->profile_photo_path ?? 'default-profile/admin-profile.png' }}" alt="message user image">
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text">
                  {{ $message->message }}
              </div>
              <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
            @endif
            
            
            @endforeach



          </div>
          <!--/.direct-chat-messages-->

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <form wire:submit.prevent="store_message" enctype="multipart/form-data">
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control" wire:model="message" autocomplete="off">
              <span class="input-group-append">
                <button type="submit" class="btn btn-primary">Send</button>
              </span>
            </div>
          </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!--/.direct-chat -->
  </div>