<?php $id = empty($machine->id) ? 0 : $machine->id; ?>
<div class="col-12 col-md-4 col-lg-3 mb-4">
    <div class="card border-0 shadow-sm border-raduis-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-machine-<?= $id; ?>" class="text-muted" style="text-decoration: underline;">
                    <?= empty($machine->name) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucfirst($machine->name), 16); ?>
                </a>
                <div class="dropdown">
                    <a href="javascript:;" class="text-muted" id="machine-shortname-display" data-toggle="dropdown" data-offset="4"> 
                        <i class="icofont-caret-down"></i>
                    </a>
                    <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="machine-shortname-display">
                        <a class="dropdown-item border-0" href="javascript:;">
                            <?= empty($machine->shortname) ? 'Nill' : $machine->shortname; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-mintcream border-0 d-flex justify-content-between" style="border-radius: 0 0 14px 14px;">
            <small class="text-muted">
                <?= empty($machine->date) ? '10th May 1970' : Bullnet\Core\Help::formatDate($machine->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-machine-<?= $id; ?>" class="text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-machine" data-url="<?= DOMAIN; ?>/categories/delete/<?= $id; ?>">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>