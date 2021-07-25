<div class="wrapper">
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'frontend' . DS . 'navbar.php'; ?>
	<section class="" style="padding: 130px 0 80px;">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9">
					<h4 class="msugreen mb-3">Blogs Posts By Category</h4>
					<?php if(empty($allArticlesByCategory)): ?>
						<div class="alert alert-info">No Blog Posts Yet</div>
					<?php else: ?>
						<div class="row">
							<?php foreach($allArticlesByCategory as $article): ?>
							   <?php require VIEWS_PATH . DS . 'blog' . DS . 'partials' . DS . 'listings.php'; ?>
						    <?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<?php require VIEWS_PATH . DS . 'blog' . DS . 'partials' . DS . 'categories.php'; ?>
				</div>
			</div>
		</div>
	</section>
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'frontend' . DS . 'footer.php'; ?>
</div>