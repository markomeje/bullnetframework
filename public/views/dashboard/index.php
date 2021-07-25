<div class="backend-wrapper bg-light vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "topbar.php"; ?>
    <div class="dashboard-section">
	    <div class="container">
    		<div class="d-flex justify-content-between align-items-center mb-3">
    			<h5 class="text-muted mb-0">Dashboard</h5>
    			<div class="text-info">
    				<?= date("F j, Y"); ?>
    			</div>
    		</div>
	    	<div class="row dashboard-panels">
	    		<?php require VIEWS_PATH . DS . "dashboard" . DS . "partials" . DS . "panels.php"; ?>
	    	</div>
            <button class="btn btn-lg btn-light upload-button" data-url="<?= DOMAIN; ?>/users/upload">Upload File</button>
	    	<div class="upload-section d-block bg-dark rounded cursor-pointer mb-4">
                <input type="file" name="upfile" accept="image/*" class="upload-input" style='display: none;'>
                <img src="" class="img-fluid w-100 preview"> 
            </div>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "sidebar.php"; ?>
</div>
