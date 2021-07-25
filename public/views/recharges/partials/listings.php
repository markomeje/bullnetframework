<?php $id = empty($recharge->id) ? 0 : $recharge->id; ?>
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card border-0 shadow-sm border-raduis-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-recharge-<?= $id; ?>" class="text-muted">
                    Amount (<?= empty($recharge->amount) ? 'Nill' : 'N'.number_format($recharge->amount); ?>)
                </a>
                <div class="">
                    <div class="dropdown">
                        <a href="javascript:;" class="text-muted" id="recharge-email-display-<?= $id; ?>" data-toggle="dropdown" data-offset="4"> 
                            Pos <i class="icofont-caret-down"></i>
                        </a>
                        <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="recharge-email-display-<?= $id; ?>">
                            <a class="dropdown-item border-0 text-muted" href="javascript:;">
                                <?= empty($recharge->machinename) ? 'Nill' : ucfirst($recharge->machinename); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-muted">
                    <?= empty($recharge->productname) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucfirst($recharge->productname), 15); ?>
                </div>
                <div class="text-muted">
                    <?= empty($recharge->charge) ? 'No Charge' : 'Charge (N'.number_format($recharge->charge).')'; ?>
                </div>
            </div>
        </div>
        <div class="card-footer bg-mintcream border-0 d-flex justify-content-between" style="border-radius: 0 0 14px 14px;">
            <small class="text-muted">
                <?= empty($recharge->date) ? '10th May 1850' : Bullnet\Core\Help::formatDatetime($recharge->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-recharge-<?= $id; ?>" class="text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-recharge" data-url="<?= DOMAIN; ?>/recharges/delete/<?= $id; ?>" disabled="">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>