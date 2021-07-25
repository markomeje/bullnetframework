<?php $id = empty($article->id) ? 0 : $article->id; ?>
<?php $status = empty($article->status) ? '' : strtolower($article->status); ?>
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card">
        <div class="card-img position-relative">
            <div class="position-absolute d-flex justify-content-between px-3 align-items-center" style="left: 0; bottom: 0; right: 0; z-index: 3; height: 50px; line-height: 50px; background-color: rgba(0, 0, 0, 0.4);">
                <div class="text-white">(1300 x 852)</div>
                <div class="d-flex position-relative">
                    <small>
                        <i class="icofont-edit mr-2 cursor-pointer text-success add-article-image-<?= $id; ?>" data-id="<?= $id; ?>">
                        </i>
                    </small>
                    <small>
                        <i class="icofont-trash text-center cursor-pointer text-danger delete-article-image"></i>
                    </small>
                </div>
            </div>
            <input type="file" name="blogimage" accept="image/*" class="article-image-input-<?= $id; ?>" style='display: none;' data-url="<?= DOMAIN; ?>/articles/image/upload/<?= $id; ?>">

            <div class="add-article-image-loader-<?= $id; ?> d-none position-absolute p-3 rounded-circle text-center border" style="bottom: 50%; right: 50%; z-index: 4; transform: translate(50%, 50%); background-color: rgba(0, 0, 0, 0.75); width: 70px; height: 70px; line-height: 40px;" data-id="<?= $id; ?>">
                <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg">
            </div>

            <div style="height: 210px;">
                <img src="<?= PUBLIC_URL; ?>/images/articles/<?= empty($article->image) ? 'default.jpg' : $article->image; ?>" class="img-fluid article-image-preview-<?= $id; ?> h-100 w-100 object-fit-cover">
            </div>
        </div>
        <div class="card-body">
            <div class="pb-3 mb-3 border-bottom d-flex justify-content-between align-items-center">
                <p class="mb-0 edit-article">
                    <a href="<?= DOMAIN; ?>/articles/update/<?= $id; ?>" class="text-muted" style="text-decoration: underline;">
                        <?= empty($article->title) ? 'Nill' : Bullnet\Core\Help::limitStringLength(ucfirst($article->title), 18); ?>
                    </a>
                </p>
                <div class="dropdown">
                    <div class="<?= $status === 'published' ? 'text-success' : 'text-danger'; ?> d-flex align-items-center cursor-pointer" id="dropdown-<?= $id; ?>" data-toggle="dropdown" style="text-decoration: underline;">
                        <div class="mr-1">
                            <?= ucfirst($status); ?>
                        </div>
                        <i class="icofont-caret-down"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-<?= $id; ?>">
                        <?php if($status === 'published'): ?>
                            <a href="javascript:;" data-url="<?= DOMAIN; ?>/articles/status/unpublished" class="dropdown-item">Unpublish</a>
                        <?php else: ?>
                            <a href="javascript:;" data-url="<?= DOMAIN; ?>/articles/status/published" class="dropdown-item">Publish</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    <?= empty($article->categoryname) ? 'No Category' : ucfirst($article->categoryname); ?>
                </div>
                <div class="position-relative mt-1">
                    <div class="comment-count position-absolute text-white text-center" style="top: -15px;">
                        <span class="badge bg-danger">9</span>
                    </div>
                    <i class="icofont-speech-comments text-success"></i>
                </div>
            </div>
        </div>
        <div class="card-footer bg-skyblue d-flex justify-content-between">
            <small class="text-white">
                <?= empty($article->date) ? '10th May 1970' : Bullnet\Library\Timeago::make($article->date); ?>
            </small>
            <div class="d-flex">
                <small class="mr-2">
                    <a href="<?= DOMAIN; ?>/articles/update/<?= $id; ?>" class=" text-warning">
                        <i class="icofont-edit"></i>
                    </a>
                </small>
                <small class="text-danger cursor-pointer delete-article" data-url="<?= DOMAIN; ?>/categories/delete/<?= $id; ?>">
                    <i class="icofont-trash"></i>
                </small>
            </div>
        </div>
    </div>
</div>