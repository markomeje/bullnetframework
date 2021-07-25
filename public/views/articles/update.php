<div class="wrapper bg-light min-vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
            <?php if(empty($article)): ?>
                <div class="alert alert-info">Article not found</div>
            <?php else: ?>
                <div class="text-muted mb-3">Update Article</div>
                <div class="p-4 border">
                    <form method="post" action="javascript:;" class="edit-article-form" data-action="<?= DOMAIN; ?>/articles/edit/<?= empty($article->id) ? 0 : $article->id; ?>" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group input-group-lg col-md-6">
                                <label class="form-label text-muted">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg title" placeholder="e.g., How To Stay Motivated" value="<?= empty($article->title) ? '' : $article->title; ?>">
                                <small class="invalid-feedback title-error"></small>
                            </div>
                            <div class="form-group input-group-lg col-md-6">
                                <label class="form-label text-muted">Category</label>
                                <select class="custom-select form-control category" name="category">
                                    <option value="">Select Category</option> 
                                    <?php if(empty($allCategories)): ?>
                                        <option value="">No Categories</option>
                                    <?php else: ?>
                                        <?php $uniquecategories = array_map('unserialize', array_unique(array_map('serialize', $allCategories))); ?>
                                        <?php foreach ($uniquecategories as $key => $category): ?>
                                            <?php $id = empty($category->id) ? 0 : (int)$category->id; ?>
                                            <option value="<?= $id; ?>" <?= (int)$article->category === $id ? 'selected=""' : ''; ?> >
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
                                <input type="text" name="author" class="form-control form-control-lg author" placeholder="e.g., Kosy Levison" value="<?= empty($article->author) ? '' : $article->author; ?>">
                                <small class="invalid-feedback author-error"></small>
                            </div>
                            <div class="form-group input-group-lg col-md-6">
                                <label class="form-label text-muted">Status</label>
                                <select class="custom-select form-control status" name="status">
                                    <option value="">Select Status</option>
                                    <?php if(empty($allArticleStatus)): ?>
                                        <option value="">No Status</option>
                                    <?php else: ?>
                                        <?php foreach($allArticleStatus as $status): ?>
                                            <option value="<?= empty($status) ? 0 : $status; ?>" <?= !empty($article->status) && strtolower($article->status) === strtolower($status) ? 'selected' : ''; ?>>
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
                            <textarea class="form-control content w-100" name="content" id="edit-article-content" rows="10"><?= empty($article->content) ? '' : $article->content; ?></textarea>
                            <small class="error content-error text-danger"></small>
                        </div>
                        <div class="modal-footer border-0 p-0">
                            <button type="submit" class="btn btn-lg bg-msugreen text-white edit-article-button px-4">
                                <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none edit-article-spinner mb-1">
                                Save
                            </button>
                            <button type="submit" class="btn btn-lg bg-danger text-white clear-form px-4">
                                Clear
                            </button>
                        </div>
                        <div class="alert alert-danger mt-3 mb-1 edit-article-message d-none"></div>
                    </form>
                </div><br>
            <?php endif; ?>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "sidebar.php"; ?>
</div>
 