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
                <?php $panels = [
                    'withdrawals' => ['link' => 'withdrawals', 'icon' => ['bg' => 'bg-primary'], 'data' => ['count' => '230']],
                    'branches' => ['link' => 'branches', 'icon' => ['bg' => 'bg-warning'], 'data' => ['count' => '56']],
                    'cashiers' => ['link' => 'cashiers', 'icon' => ['bg' => 'bg-dark'], 'data' => ['count' => '122']],
                    'accounts' => ['link' => 'accounts', 'icon' => ['bg' => 'bg-success'], 'data' => ['count' => '04']],
                    'products' => ['link' => 'products', 'icon' => ['bg' => 'bg-info'], 'data' => ['count' => 'N400298']],
                    'machines' => ['link' => 'machines', 'icon' => ['bg' => 'bg-secondary'], 'data' => ['count' => '03']],
                    'banks' => ['link' => 'banks', 'icon' => ['bg' => 'bg-danger'], 'data' => ['count' => '22']],
                    'deposits' => ['link' => 'deposits', 'icon' => ['bg' => 'bg-warning'], 'data' => ['count' => '230']],
                    'recharges' => ['link' => 'recharges', 'icon' => ['bg' => 'bg-success'], 'data' => ['count' => '230']],
                    'capitals' => ['link' => 'capitals', 'icon' => ['bg' => 'bg-primary'], 'data' => ['count' => '230']]
                ]; 
                ?>
                <?php if($panels): ?>
                    <?php foreach ($panels as $name => $value): ?>
                        <div class="col-12 col-md-4 col-lg-3 mb-4">
                            <div class="card border-0 rounded bg-white shadow-sm border-raduis-lg">
                                <div class="card-body d-flex align-items-center br-sm">
                                    <div class="panel-icons rounded-circle <?= isset($value['icon']['bg']) ? $value['icon']['bg'] : 'bg-light'; ?> text-center mr-3 text-white position-relative">
                                        <i class="icofont-pen"></i> 
                                    </div>
                                    <div class="d-block w-100">
                                        <a href="<?= isset($value['link']) ? DOMAIN.'/'.$value['link'] : 'javascript:;'; ?>" class="d-block text-muted mb-1" style="text-decoration: underline;">
                                            <?= isset($name) ? ucfirst($name) : ''; ?>
                                        </a>
                                        <h6 class="text-muted mb-0">
                                            <?= isset($value['data']['count']) ? $value['data']['count'] : '0'; ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
