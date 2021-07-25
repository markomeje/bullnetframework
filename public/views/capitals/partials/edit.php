<?php $id = empty($capital->id) ? 0 : $capital->id; ?>
<div class="modal fade" id="edit-capital-<?= $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="edit-capital-form" data-action="<?= DOMAIN; ?>/capitals/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Add Capital</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-group input-group-lg col-md-6">
                            <label for="" class="text-muted mb-2">Capital Type</label>
                            <select class="form-control custom-select type text-muted" name="type">
                                <option value="">Select Type</option>
                                <?php if(empty($capitalTypes)): ?>
                                    <option value="">No Types Listed</option>
                                <?php else: ?>
                                    <?php foreach($capitalTypes as $type): ?>
                                        <?= $type = empty($type) ? '' : $type; ?>
                                        <option value="<?= ucwords($type); ?>">
                                            <?= ucwords($type); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="error type-error text-danger"></small>
                        </div>
                        <div class="form-group col-md-6">
							<label class="text-muted mb-2">Amount</label>
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
					</div>
                    <div class="alert mb-3 edit-capital-message d-none"></div>
                    <div class="d-flex float-right mb-4 mt-2">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white edit-capital-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none edit-capital-spinner mb-1">
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