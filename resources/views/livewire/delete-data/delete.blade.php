<div>
    <div class="modal-content">
        <div class="modal-header flex-column">
            <div class="icon-box">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h4 class="modal-title w-100">Are you sure?</h4>
            <button type="button" class="close" aria-hidden="true" wire:click="closeDeleteConfirmationModal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Do you really want to delete these records? This process cannot be undone.</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" wire:click="closeDeleteConfirmationModal">Cancel</button>
            <button type="button" class="btn btn-danger" wire:click="deleteData">Delete</button>
        </div>
    </div>
</div>
