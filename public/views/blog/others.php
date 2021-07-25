<div class="pt-3">
	<h5 class="mb-0 text-msugreen">Other Recent Article(s)</h5>
	<?php if(empty($allPublishedArticles)): ?>
		<div class="alert alert-info mt-3">No Other Blog Article(s) Found</div>
	<?php else: ?>
		<div class="row pt-3">
			<?php $filteredArticles = array_filter($allPublishedArticles, function($article) use($articleid) { 
				return (int)$article->id !== $articleid;
			}); ?>
			<?php $slicedArticles = count($filteredArticles) > 4 ? array_slice($filteredArticles, 0, 4) : $filteredArticles; ?>
			<?php foreach($slicedArticles as $article): ?>
				<?php require VIEWS_PATH . DS . 'blog' . DS . 'partials' . DS . 'listings.php'; ?>
		    <?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>