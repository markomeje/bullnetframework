<div class="wrapper bg-mintcream min-vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
    		<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    			<div class="text-muted mb-0">Dashboard</div>
    			<div class="text-info">
    				<?= date("F j, Y"); ?>
    			</div>
    		</div>
	    	<div class="row">
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 rounded bg-white shadow-sm border-raduis-lg">
                        <div class="card-body d-flex align-items-center br-sm">
                            <div class="panel-icons rounded-circle bg-dark text-center mr-3 text-white position-relative">
                                <i class="icofont-pen"></i> 
                            </div>
                            <div class="d-block w-100">
                                <a href="<?= DOMAIN.'/withdrawals'; ?>" class="d-block text-muted mb-1" style="text-decoration: underline;">
                                    Withdrawals
                                </a>
                                <h6 class="text-muted mb-0">
                                    N<?= '2300'; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 rounded bg-white shadow-sm border-raduis-lg">
                        <div class="card-body d-flex align-items-center br-sm">
                            <div class="panel-icons rounded-circle bg-success text-center mr-3 text-white position-relative">
                                <i class="icofont-pen"></i> 
                            </div>
                            <div class="d-block w-100">
                                <a href="<?= DOMAIN.'/deposits'; ?>" class="d-block text-muted mb-1" style="text-decoration: underline;">
                                    Deposits
                                </a>
                                <h6 class="text-muted mb-0">
                                    N<?= '1190'; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 rounded bg-white shadow-sm border-raduis-lg">
                        <div class="card-body d-flex align-items-center br-sm">
                            <div class="panel-icons rounded-circle bg-warning text-center mr-3 text-white position-relative">
                                <i class="icofont-pen"></i> 
                            </div>
                            <div class="d-block w-100">
                                <a href="<?= DOMAIN.'/capitals'; ?>" class="d-block text-muted mb-1" style="text-decoration: underline;">
                                    Capitals
                                </a>
                                <h6 class="text-muted mb-0">
                                    N<?= '1900'; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 rounded bg-white shadow-sm border-raduis-lg">
                        <div class="card-body d-flex align-items-center br-sm">
                            <div class="panel-icons rounded-circle bg-danger text-center mr-3 text-white position-relative">
                                <i class="icofont-pen"></i> 
                            </div>
                            <div class="d-block w-100">
                                <a href="<?= DOMAIN.'/recharges'; ?>" class="d-block text-muted mb-1" style="text-decoration: underline;">
                                    Recharges
                                </a>
                                <h6 class="text-muted mb-0">
                                    N<?= '4350'; ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
	    	</div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between"></div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "sidebar.php"; ?>
</div>
