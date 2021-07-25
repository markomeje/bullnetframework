<?php use Bullnet\Library\Authenticated; ?>
<div class="wrapper bg-mintcream min-vh-100">
	<?php require VIEWS_PATH . DS . "layouts" . DS . "topbar.php"; ?>
    <div class="section-padding">
	    <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-1"> 
                <div class="d-flex align-items-center flex-wrap">
                    <a href="javascript:;" class="text-white mr-2 mb-3 bg-info shadow-sm btn btn-sm rounded-pill px-4" onclick="window.history.go(-1)">
                        <i class="icofont-arrow-left"></i> Back
                    </a>
                    <a href="<?= DOMAIN; ?>/withdrawals" class="text-muted mb-3 mr-2 bg-white shadow-sm btn btn-sm rounded-pill px-4">
                        All Withdrawals
                    </a>
                    <?php if(Authenticated::user()->role === 'cashier'): ?>
                        <a href="javascript:;" data-toggle="modal" data-target="#add-withdrawal" class="text-muted mb-3 mr-2 bg-white shadow-sm btn btn-sm rounded-pill px-4">
                            Add Withdrawal
                        </a>
                        <?php require VIEWS_PATH . DS . 'withdrawals' . DS . 'partials' . DS . 'add.php'; ?>
                    <?php endif; ?>
                    
                </div>
                <div class="d-flex align-items-center">
                    <div class="mb-3 mr-2">
                        <div class="form-group input-group-sm m-0">
                            <input type="date" class="border-0 rounded-pill form-control filter text-muted shadow-sm pl-3" name="filter" value="<?= date("Y-F-j"); ?>">
                        </div>
                    </div>
                    <div class="dropdown mb-3">
                        <a href="javascript:;" class="text-muted bg-white shadow-sm btn btn-sm rounded-pill px-4" id="options-articles-menu" data-toggle="dropdown">Options <i class="icofont-caret-down"></i>
                        </a>
                        <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="options-articles-menu">
                            <a class="dropdown-item border-0" href="javascript:;" data-url="">Delete All</a>
                        </div>
                    </div> 
                </div>
            </div>
            <?php if(Authenticated::user()->role === 'cashier'): ?>
                <?php if(empty($allCashierWithdrawals)): ?>
                    <div class="alert alert-info">No withdrawals yet</div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach($allCashierWithdrawals as $withdrawal): ?>
                            <?php require VIEWS_PATH . DS . 'withdrawals' . DS . 'partials' . DS . 'listings.php'; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach($allCashierWithdrawals as $withdrawal): ?>
                        <?php require VIEWS_PATH . DS . 'withdrawals' . DS . 'partials' . DS . 'edit.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php elseif (Authenticated::user()->role === 'admin'): ?>
                <?php if(empty($allWithdrawals)): ?>
                    <div class="alert alert-info">No withdrawals yet</div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach($allWithdrawals as $withdrawal): ?>
                            <?php require VIEWS_PATH . DS . 'withdrawals' . DS . 'partials' . DS . 'listings.php'; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach($allWithdrawals as $withdrawal): ?>
                        <?php require VIEWS_PATH . DS . 'withdrawals' . DS . 'partials' . DS . 'edit.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
	    </div>
    </div>
    <?php require VIEWS_PATH . DS . "layouts" . DS . "sidebar.php"; ?>
</div>
 