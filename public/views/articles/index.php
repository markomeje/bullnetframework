<div class="wrapper bg-light vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
    		<div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <a href="<?= DOMAIN; ?>/articles/create" class="bg-pumpkin btn btn-sm rounded-pill text-white px-4">Add Article</a>
                </div>
                <div class="d-flex align-items-center dropdown" data-offset="4">
                    <a href="javascript:;" class="bg-skyblue btn btn-sm rounded-pill text-white px-4" id="options-articles-menu" data-toggle="dropdown" data-offset="4">Options 
                        <i class="icofont-caret-down"></i>
                    </a>
                    <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="options-articles-menu">
                        <a class="dropdown-item" href="javascript:;" data-url="">Delete All</a>
                    </div>
                </div>
            </div>
            <?php if(empty($allArticles)): ?>
                <div class="alert alert-info">No articles Added</div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($allArticles as $article): ?>
                        <?php require VIEWS_PATH . DS . 'articles' . DS . 'partials' . DS . 'listings.php'; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "backend" . DS . "sidebar.php"; ?>
</div>
 