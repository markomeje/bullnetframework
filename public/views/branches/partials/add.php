<div class="modal fade" id="add-branch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="add-branch-form" data-action="<?= DOMAIN; ?>/branches/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Add Branch</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
    					<div class="form-group input-group-lg col-md-6">
    						<label class="text-muted mb-2">Branch Name</label>
    						<input type="text" name="name" class="form-control name" placeholder="e.g., Ikoyi Main">
    						<small class="error name-error text-danger"></small>
    					</div>
                        <div class="form-group input-group-lg col-md-6">
                            <label class="text-muted mb-2">Branch Address</label>
                            <input type="text" name="address" class="form-control address" placeholder="e.g., 44 Brain Street Ikoyi.">
                            <small class="error address-error text-danger"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 add-branch-message d-none"></div>
                    <div class="d-flex float-right mb-4 mt-2">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white add-branch-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none add-branch-spinner mb-1">
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