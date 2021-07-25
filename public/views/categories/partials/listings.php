<?php $id = empty($category->id) ? 0 : $category->id; ?>
<div class="col-12 col-md-4 col-lg-3 mb-4">
    <div class="card">
        <div class="card-body">
            <p class="m-0 p-0 edit-category">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-category-<?= $id; ?>" class="text-muted" style="text-decoration: underline;">
                    <?= empty($category->name) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucfirst($category->name), 18); ?>
                </a>
            </p>
        </div>
        <div class="card-footer bg-skyblue d-flex justify-content-between">
            <small class="text-white">
                <?= empty($category->date) ? '10th May 1970' : Bullnet\Core\Help::formatDate($category->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#edit-category-<?= $id; ?>" class=" text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-category" data-url="<?= DOMAIN; ?>/categories/delete/<?= $id; ?>">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>