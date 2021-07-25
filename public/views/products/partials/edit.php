<?php $id = empty($product->id) ? 0 : $product->id; ?>
<div class="modal fade" id="edit-product-<?= $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered border-raduis-lg" role="document">
        <div class="modal-content border-raduis-lg">
            <form method="post" action="javascript:;" class="edit-product-form" data-action="<?= DOMAIN; ?>/products/add" autocomplete="off">
                <div class="modal-body">
                    <div class="d-flex justify-content-between pb-2 mb-3 border-bottom">
                        <p class="modal-title text-muted mb-0">Edit Product</p>
                        <div class="cursor-pointer mb-0" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
					<div class="form-group input-group-lg">
						<label for="" class="text-muted mb-2">Product Name</label>
						<input type="text" name="productname" class="form-control productname" placeholder="e.g., Airtime" value="<?= empty($product->productname) ? '' : $product->productname; ?>">
						<small class="error productname-error text-danger"></small>
					</div>
                    <div class="alert mb-3 edit-product-message d-none"></div>
                    <div class="d-flex float-right mb-4 mt-2">
                        <button type="submit" class="btn btn-lg bg-blueviolet text-white edit-product-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none edit-product-spinner mb-1">
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