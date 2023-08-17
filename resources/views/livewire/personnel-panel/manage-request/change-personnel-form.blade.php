<div>
    <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Change Personnel</h3>
          <button type="button" class="close" wire:click="closeChangePersonnelModal" id="button-reset">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group">
              <label for="personnel_id">Assign Personnel</label>
              <select class="form-control" id="personnel_id" wire:model="personnel_id" required>
                <option value="">Select a Personnel</option>
                @foreach($assign_personnel as $personnel)
                  <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                @endforeach
              </select>
              @error('personnel_id') <span class="error" style="color: red">{{ $message }}</span> @enderror
            </div>
          </div>
          <!-- /.card-body -->
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" wire:click="changepersonnelid">Yes</button>
            <button type="button" class="btn btn-secondary" wire:click="closeChangePersonnelModal">No</button>
          </div>
        </form>
    </div>
</div>