<?php $userid = empty($cashier->userid) ? 0 : $cashier->userid; ?>
<div class="modal fade" id="edit-cashier-<?= $userid; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="edit-cashier-form" data-action="<?= DOMAIN; ?>/cashiers/edit/<?= $userid; ?>" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Edit Cashier</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Firstname</label>
							<input type="text" name="firstname" class="form-control form-control-lg firstname" placeholder="e.g., john" value="<?= empty($cashier->firstname) ? '' : $cashier->firstname; ?>">
							<small class="error firstname-error text-danger"></small>
						</div>
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Lastname</label>
							<input type="text" name="lastname" class="form-control form-control-lg lastname" placeholder="e.g., doe" value="<?= empty($cashier->lastname) ? '' : $cashier->lastname; ?>">
							<small class="error lastname-error text-danger"></small>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Email (Uneditable)</label>
							 <input type="email" name="email" class="form-control form-control-lg email" placeholder="e.g., john@doe.com" value="<?= empty($cashier->email) ? '' : $cashier->email; ?>" disabled="">
							 <small class="error email-error text-danger"></small>
						</div>
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Phone</label>
							 <input type="text" name="phone" class="form-control form-control-lg phone" placeholder="e.g., 09011112113" value="<?= empty($cashier->phone) ? '' : $cashier->phone; ?>">
							 <small class="error phone-error text-danger"></small>
						</div>
					</div>
                    <div class="form-group">
                        <label class="text-muted">Address</label>
                        <textarea class="form-control address" name="address" rows="3" placeholder="Enter cashier address"><?= empty($cashier->address) ? '' : $cashier->address; ?></textarea>
                        <small class="error address-error text-danger"></small>
                    </div>
                    <div class="alert mb-3 edit-cashier-message d-none"></div>
                    <div class="d-flex float-right mb-4">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white edit-cashier-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none edit-cashier-spinner mb-1">
                            Save
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