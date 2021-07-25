<div class="modal fade" id="add-bank" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered br-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-muted mb-0">Add bank</p>
                <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <i class="icofont-close text-danger"></i>
                </div>
            </div>
            <form method="post" action="javascript:;" class="add-bank-form" data-action="<?= DOMAIN; ?>/banks/add" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg name" placeholder="e.g., Motivational">
                        <small class="invalid-feedback name-error"></small>
                    </div>
                </div>
                <div class="alert mb-3 add-bank-message d-none"></div>
                <div>
                    <div class="d-flex justify-content-right">
                        <button type="submit" class="btn btn-lg bg-msugreen text-white add-bank-button px-4">
                            <img src="/images/svgs/spinner.svg" class="mr-2 d-none add-bank-spinner mb-1">
                            Submit
                        </button>
                        <button type="button" class="btn btn-lg bg-danger ml-3 text-white" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>