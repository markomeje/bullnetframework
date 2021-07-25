<?php $id = empty($withdrawal->id) ? 0 : $withdrawal->id; ?>
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card border-0 shadow-sm border-raduis-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-withdrawal-<?= $id; ?>" class="text-muted">
                    Amount (<?= empty($withdrawal->amount) ? 'Nill' : 'N'.number_format($withdrawal->amount); ?>)
                </a>
                <div class="">
                    <div class="dropdown">
                        <a href="javascript:;" class="text-muted" id="withdrawal-email-display-<?= $id; ?>" data-toggle="dropdown" data-offset="4"> 
                            Bank <i class="icofont-caret-down"></i>
                        </a>
                        <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="withdrawal-email-display-<?= $id; ?>">
                            <a class="dropdown-item border-0 text-muted" href="javascript:;">
                                <?= empty($withdrawal->bankname) ? 'Nill' : ucfirst($withdrawal->bankname); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <?php $phone = empty($withdrawal->phone) ? 'Nill' : $withdrawal->phone; ?>
                <a href="tel:<?= $phone; ?>" class="text-muted">
                    <?= $phone; ?>
                </a>
                <div class="text-muted">
                    Charge (<?= empty($withdrawal->charge) ? 'Nill' : 'N'.number_format($withdrawal->charge); ?>)
                </div>
            </div>
        </div>
        <div class="card-footer bg-mintcream border-0 d-flex justify-content-between" style="border-radius: 0 0 14px 14px;">
            <small class="text-muted">
                <?= empty($withdrawal->date) ? '10th May 1850' : Bullnet\Core\Help::formatDatetime($withdrawal->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-withdrawal-<?= $id; ?>" class="text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-withdrawal" data-url="<?= DOMAIN; ?>/withdrawals/delete/<?= $id; ?>" disabled="">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>