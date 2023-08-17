<div>
    <div class="modal-content">
        <div class="modal-header flex-column">
            <div class="icon-box">
                <i class="fas fa-times"></i>
            </div>
            <h4 class="modal-title w-100">Remarks</h4>
            <button type="button" class="close" aria-hidden="true" wire:click="closeCancelConfirmationModal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" id="cancel_reason" wire:model="cancel_reason" required>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary" wire:click="cancelData">Yes</button>
            <button type="button" class="btn btn-secondary" wire:click="closeCancelConfirmationModal">No</button>
        </div>
    </div>
</div>
