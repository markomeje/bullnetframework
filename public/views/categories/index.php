<div class="wrapper bg-light vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
    		<div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <!-- <h5 class="text-muted mb-0 mr-4">Categories</h5> -->
                    <a href="javascript:;" class="bg-skyblue btn btn-sm rounded-pill text-white px-4" data-toggle="modal" data-target="#add-category">Add Category</a>
                    <?php require VIEWS_PATH . DS . 'categories' . DS . 'partials' . DS . 'add.php'; ?>
                </div>
    		</div>
            <?php if(empty($categories)): ?>
                <div class="alert alert-info">No Categories Added</div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($categories as $category): ?>
                        <?php require VIEWS_PATH . DS . 'categories' . DS . 'partials' . DS . 'listings.php'; ?>
                    <?php endforeach; ?>
                </div>
                <?php foreach($categories as $category): ?>
                    <?php require VIEWS_PATH . DS . 'categories' . DS . 'partials' . DS . 'edit.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "sidebar.php"; ?>
</div>
 