<div class="modal fade" id="add-bank" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="add-bank-form" data-action="<?= DOMAIN; ?>/banks/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Add Bank</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label class="text-muted">Bank fullname</label>
                            <input type="text" name="fullname" class="form-control form-control-lg fullname" placeholder="e.g., First Bank Of Nigeria">
                            <small class="invalid-feedback fullname-error"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-muted">Bank shortname</label>
                            <input type="text" name="shortname" class="form-control form-control-lg shortname" placeholder="e.g., FBN">
                            <small class="invalid-feedback shortname-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-bank-message d-none"></div>
                    <div class="d-flex float-right mb-4">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white add-bank-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none add-bank-spinner mb-1">
                            Submit
                        </button>
                        <button type="button" class="btn btn-lg bg-maximumred ml-3 text-white" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>