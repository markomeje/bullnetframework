<?php $userid = empty($cashier->userid) ? 0 : $cashier->userid; ?>
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card border-0 shadow-sm border-raduis-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-cashier-<?= $userid; ?>" class="text-muted" style="text-decoration: underline;">
                    <?php $fullname = $cashier->firstname.' '.$cashier->lastname; ?>
                    <?= empty($fullname) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucwords($fullname), 16); ?>
                </a>
                <div class="">
                    <div class="dropdown">
                        <a href="javascript:;" class="text-muted" id="cashier-email-display-<?= $userid; ?>" data-toggle="dropdown" data-offset="4"> 
                            Address <i class="icofont-caret-down"></i>
                        </a>
                        <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="cashier-email-display-<?= $userid; ?>">
                            <a class="dropdown-item border-0 text-muted" href="javascript:;">
                                <?= empty($cashier->address) ? 'Nill' : $cashier->address; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <?php $phone = empty($cashier->phone) ? 'Nill' : $cashier->phone; ?>
                <a href="tel:<?= $phone; ?>" class="text-muted">
                    <?= $phone; ?>
                </a>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="cashier-enabled-status-<?= $userid; ?>" value="on" name="status" <?= !empty($cashier->enabled) && strtolower($cashier->enabled) === 'yes' ? 'checked=""' : ''; ?>>
                    <label class="custom-control-label cursor-pointer text-muted" for="cashier-enabled-status-<?= $userid; ?>"></label>
                </div>
            </div>
        </div>
        <div class="card-footer bg-mintcream border-0 d-flex justify-content-between" style="border-radius: 0 0 14px 14px;">
            <div class="text-muted">
                <?= empty($cashier->date) ? '10th May 1850' : Bullnet\Core\Help::formatDate($cashier->date); ?>
            </div>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-cashier-<?= $userid; ?>" class="text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-cashier" data-url="<?= DOMAIN; ?>/cashiers/delete/<?= $userid; ?>">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>