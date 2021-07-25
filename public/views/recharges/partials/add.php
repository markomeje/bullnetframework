<div class="modal fade" id="add-recharge" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="add-recharge-form" data-action="<?= DOMAIN; ?>/recharges/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Add Recharge</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-group input-group-lg col-md-6">
                            <label for="" class="text-muted mb-2">Product Name</label>
                            <select class="form-control custom-select product text-muted" name="product">
                                <option value="">Select Product</option>
                                <?php if(empty($allProducts)): ?>
                                    <option value="">No Products Listed</option>
                                <?php else: ?>
                                    <?php foreach($allProducts as $product): ?>
                                        <option value="<?= empty($product->id) ? 0 : $product->id; ?>">
                                            <?= empty($product->productname) ? 'Nill' : ucwords($product->productname); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="error product-error text-danger"></small>
                        </div>
						<div class="form-group input-group-lg col-md-6">
							<label for="" class="text-muted mb-2">Pos Machine</label>
                            <select class="form-control custom-select machine text-muted" name="machine">
                                <option value="">Select Pos Machine</option>
                                <?php if(empty($allMachines)): ?>
                                    <option value="">No Bank Names</option>
                                <?php else: ?>
                                    <?php foreach($allMachines as $machine): ?>
                                        <option value="<?= empty($machine->id) ? 0 : $machine->id; ?>">
                                            <?= empty($machine->machinename) ? 'Nill' : ucwords($machine->machinename); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
							<small class="error machine-error text-danger"></small>
						</div>
					</div>
					<div class="form-row">
                        <div class="form-group col-md-6">
							<label class="text-muted mb-2">Recharge Amount</label>
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
                        <div class="form-group col-md-6">
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
                    <div class="alert mb-3 add-recharge-message d-none"></div>
                    <div class="d-flex float-right mb-4 mt-2">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white add-recharge-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none add-recharge-spinner mb-1">
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