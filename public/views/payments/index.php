<div class="backend-wrapper bg-light min-vh-100">
	<?php require BACKEND_PATH . DS . "layouts" . DS . "navbar.php"; ?>
    <div class="payments-section">
	    <div class="container">
	    	<div class="row mb-1 payments-lists" data-url="<?= DOMAIN; ?>/payments/getall"></div>
	    </div>
    </div>
    <?php require BACKEND_PATH . DS . "layouts" . DS . "sidebar.php"; ?>
</div>
