<?php $id = empty($branch->id) ? 0 : $branch->id; ?>
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card border-0 shadow-sm border-raduis-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-branch-<?= $id; ?>" class="text-muted" style="text-decoration: underline;">
                    <?= empty($branch->name) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucwords($branch->name), 16); ?>
                </a>
                <div class="dropdown">
                    <a href="javascript:;" class="text-muted" id="branch-email-display-<?= $id; ?>" data-toggle="dropdown" data-offset="4"> 
                        Address <i class="icofont-caret-down"></i>
                    </a>
                    <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="branch-email-display-<?= $id; ?>">
                        <a class="dropdown-item border-0 text-muted" href="javascript:;">
                            <?= empty($branch->address) ? 'Nill' : $branch->address; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-mintcream border-0 d-flex justify-content-between" style="border-radius: 0 0 14px 14px;">
            <small class="text-muted">
                <?= empty($branch->date) ? '10th May 1850' : Bullnet\Core\Help::formatDate($branch->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-branch-<?= $id; ?>" class="text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-branch" data-url="<?= DOMAIN; ?>/branchs/delete/<?= $id; ?>">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>