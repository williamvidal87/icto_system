<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Client</h3>
            <button type="button" class="close" wire:click="closeClientForm" id="button-reset">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" wire:model="name">
                    @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" wire:model="email">
                    @error('email') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
                @if($this->UserID)
                    <div class="form-group">
                        <label for="newpassword">New Password</label>
                        <input type="password" class="form-control" id="newpassword" wire:model="newpassword" placeholder="New Password">
                        @error('newpassword') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" wire:model="confirmpassword" placeholder="Confirm Password">
                        @error('confirmpassword') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                @else
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" wire:model="password" placeholder="Password">
                        @error('password') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" wire:model="confirmpassword" placeholder=" Confirm Password">
                        @error('confirmpassword') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                @endif
                
            </div>
            <!-- /.card-body -->
            
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" wire:click="closeClientForm">Close</button>
                @if(!empty($this->UserID))
                    <button type="submit" class="btn btn-primary">Save changes</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>