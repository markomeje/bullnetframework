<div class="wrapper bg-mintcream min-vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
    		<div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                <div class="d-flex align-items-center flex-wrap">
                    <a href="javascript:;" data-toggle="modal" data-target="#add-bank" class="text-muted mb-3 mr-2 bg-white shadow-sm btn btn-sm rounded-pill px-4">
                        Add Bank
                    </a>
                    <?php require VIEWS_PATH . DS . 'banks' . DS . 'partials' . DS . 'add.php'; ?>
                </div>
                <div class="d-flex align-items-center flex-wrap">
                    <div class="dropdown mb-3">
                        <a href="javascript:;" class="text-muted bg-white shadow-sm btn btn-sm rounded-pill px-4" id="options-articles-menu" data-toggle="dropdown">Options <i class="icofont-caret-down"></i>
                        </a>
                        <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="options-articles-menu">
                            <a class="dropdown-item text-muted border-0" href="javascript:;" data-url="">Delete All</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(empty($allBanks)): ?>
                <div class="alert alert-info">No Banks Added Yet.</div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($allBanks as $bank): ?>
                        <?php require VIEWS_PATH . DS . 'banks' . DS . 'partials' . DS . 'listings.php'; ?>
                    <?php endforeach; ?>
                </div>
                <?php foreach($allBanks as $bank): ?>
                    <?php require VIEWS_PATH . DS . 'banks' . DS . 'partials' . DS . 'edit.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "sidebar.php"; ?>
</div>
 