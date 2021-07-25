<div class="modal fade" id="add-withdrawal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="add-withdrawal-form" data-action="<?= DOMAIN; ?>/withdrawals/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Add Withdrawal</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Customers' Phone Number</label>
							<input type="text" name="phone" class="form-control form-control-lg phone" placeholder="e.g., 09065675430">
							<small class="error phone-error text-danger"></small>
						</div>
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Bank Name</label>
                            <select class="form-control custom-select bank text-muted" name="bank">
                                <option value="">Select Bank Name</option>
                                <?php if(empty($allBanks)): ?>
                                    <option value="">No Bank Names</option>
                                <?php else: ?>
                                    <?php foreach($allBanks as $bank): ?>
                                        <option value="<?= empty($bank->id) ? 0 : $bank->id; ?>">
                                            <?= empty($bank->shortname) ? 'Nill' : ucwords($bank->shortname); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
							<small class="error bank-error text-danger"></small>
						</div>
					</div>
					<div class="form-row">
                        <div class="form-group col-lg-6">
							<label class="text-muted mb-2">Withdrawn Amount</label>
                            <div class="input-group input-group-lg ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-blueviolet">
                                        N
                                    </span>
                                </div>
                                <input type="number" name="amount" class="form-control form-control-lg amount" placeholder="e.g., 4000">
                            </div>
						    <small class="error amount-error text-danger"></small>
                        </div>
                        <div class="form-group col-lg-6">
						    <label class="text-muted mb-2">Charge</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-blueviolet">
                                        N
                                    </span>
                                </div>
                                <input type="number" name="charge" class="form-control form-control-lg charge" placeholder="e.g., 100">
                            </div>
						    <small class="error charge-error text-danger"></small>
                        </div>
					</div>
                    <div class="alert mb-3 add-withdrawal-message d-none"></div>
                    <div class="d-flex float-right mb-4 mt-2">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white add-withdrawal-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none add-withdrawal-spinner mb-1">
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