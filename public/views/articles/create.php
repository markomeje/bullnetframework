<div class="wrapper bg-light min-vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
            <div class="mb-3 text-muted">Add Article</div>
            <div class="p-4 border">
                <form method="post" action="javascript:;" class="add-article-form" data-action="<?= DOMAIN; ?>/articles/add" autocomplete="off">
                    <div class="form-row">
                        <div class="form-group input-group-lg col-md-6">
                            <label class="form-label text-muted">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg title" placeholder="e.g., How To Stay Motivated">
                            <small class="invalid-feedback title-error"></small>
                        </div>
                        <div class="form-group input-group-lg col-md-6">
                            <label class="form-label text-muted">Category</label>
                            <select class="custom-select form-control" name="category">
                                <option value="">Select Category</option>
                                <?php if(empty($allCategories)): ?>
                                        <option value="">No Categories</option>
                                <?php else: ?>
                                    <?php $uniquecategories = array_map('unserialize', array_unique(array_map('serialize', $allCategories))); ?>
                                    <?php foreach ($uniquecategories as $key => $category): ?>
                                        <option value="<?= empty($category->id) ? 0 : (int)$category->id; ?>">
                                            <?= empty($category->name) ? 'Nill' : ucfirst($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="invalid-feedback category-error"></small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group input-group-lg col-md-6">
                            <label class="form-label text-muted">Author</label>
                            <input type="text" name="author" class="form-control form-control-lg author" placeholder="e.g., Kosy Levison">
                            <small class="invalid-feedback author-error"></small>
                        </div>
                        <div class="form-group input-group-lg col-md-6">
                            <label class="form-label text-muted">Status</label>
                            <select class="custom-select form-control status" name="status">
                                <option value="">Select Status</option>
                                <?php if(empty($statuses)): ?>
                                    <option value="">No Status</option>
                                <?php else: ?>
                                    <?php foreach($statuses as $status): ?>
                                        <option value="<?= empty($status) ? 0 : $status; ?>">
                                            <?= empty($status) ? 'Nill' : ucfirst($status); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <small class="invalid-feedback status-error"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted">Content</label>
                        <textarea class="form-control content w-100" name="content" id="add-article-content" rows="10"></textarea>
                        <small class="error content-error text-danger"></small>
                    </div>
                    <div class="modal-footer border-0 p-0">
                        <button type="submit" class="btn btn-lg bg-msugreen text-white add-article-button px-4">
                            <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none add-article-spinner mb-1">
                            Save
                        </button>
                        <button type="submit" class="btn btn-lg bg-danger text-white clear-form px-4">
                            Clear
                        </button>
                    </div>
                    <div class="alert alert-danger mt-3 mb-1 add-article-message d-none"></div>
                </form>
            </div><br>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "sidebar.php"; ?>
</div>
 