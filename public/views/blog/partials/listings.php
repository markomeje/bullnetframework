<?php $articleid = empty($article->id) ? 0 : $article->id; ?>
<div class="col-12 col-lg-6">
	<?php $title = empty($article->title) ? 'Nill' : $article->title; ?>
	<?php $formattedArticleTitle = implode('-', explode(' ', strtolower($title))); ?>
	<div class="card p-0 border-0">
		<a href="<?= DOMAIN; ?>/blog/article/<?= $articleid; ?>/<?= $formattedArticleTitle; ?>" class="d-block position-relative blog-article-image-height">
			<!-- <div class="position-absolute bg-transparent border rounded" style="top: 20px; left: 20px; bottom: 20px; right: 20px; z-index: 3;"></div> -->
			<img src="<?= PUBLIC_URL; ?>/images/articles/<?= empty($article->image) ? 'default.jpg' : $article->image; ?>" class="card-img img-fluid object-fit-cover w-100 h-100">
		</a>
		<div class="card-body px-0">
			<h5 class="text-msugreen">
				<a href="<?= DOMAIN; ?>/blog/article/<?= $articleid; ?>/<?= $formattedArticleTitle; ?>" class="text-msugreen">
					<?= Bullnet\Core\Help::limitStringLength(ucwords($title), 25); ?>
				</a>
			</h5>
			<a class="text-muted mb-3 d-block" href="<?= DOMAIN; ?>/blog/article/<?= $articleid; ?>/<?= $formattedArticleTitle; ?>">
				<?= empty($article->content) ? 'Nill' : Bullnet\Core\Help::limitStringLength(strip_tags($article->content), 146); ?>
			</a>
			<div class="text-muted mb-3">
				<small><?= empty($article->date) ? 'Nill' : 'Posted '.Bullnet\Core\Help::formatDate($article->date); ?> -
				<?= empty($article->author) ? 'Nill' : '<em>By</em> '.Bullnet\Core\Help::limitStringLength($article->author, 32); ?></small>
		    </div>
		    <div class="d-flex align-items-center justify-content-between">
		    	<a href="<?= DOMAIN; ?>/blog/article/<?= $articleid; ?>/<?= $formattedArticleTitle; ?>" class="btn btn-sm bg-skyblue rounded-pill px-5 text-white mr-3">Read article</a>
		    	<div class="d-flex align-items-center">
		    		<div class="rounded-circle mr-2 position-relative text-center text-pumpkin bg-alabaster" style="width: 34px; height: 34px; line-height: 36.5px;">
		    			<i class="icofont-comment"></i>
		    		</div>
		    		<div class="rounded-circle position-relative text-center text-pumpkin bg-alabaster" style="width: 34px; height: 34px; line-height: 34px;">
		    			<i class="icofont-eye"></i>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
</div>