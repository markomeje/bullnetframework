<?php $id = empty($category->id) ? 0 : $category->id; ?>
<div class="modal fade" id="edit-category-<?= $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered br-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title text-muted mb-0">Edit Category</p>
                <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <i class="icofont-close text-danger"></i>
                </div>
            </div>
            <form method="post" action="javascript:;" class="edit-category-form edit-category-form" data-action="<?= DOMAIN; ?>/categories/edit/<?= $id; ?>" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg name" placeholder="e.g., Motivational" value="<?= empty($category->name) ? '' : $category->name; ?>">
                        <small class="invalid-feedback name-error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-right">
                        <button type="submit" class="btn btn-lg bg-msugreen text-white edit-category-button px-4">
                            <img src="/images/svgs/spinner.svg" class="mr-2 d-none edit-category-spinner mb-1">
                            Save
                        </button>
                        <button type="button" class="btn btn-lg bg-danger ml-3 text-white" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
                <div class="px-3">
                    <div class="alert mb-3 edit-category-message d-none"></div>
                </div>
            </form>
        </div>
    </div>
</div>