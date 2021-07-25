<div class="wrapper">
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'frontend' . DS . 'navbar.php'; ?>
	<section class="" style="padding: 130px 0 80px;">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9">
					<h4 class="msugreen mb-3">Our Latest Blogs</h4>
					<?php if(empty($allPublishedArticles)): ?>
						<div class="alert alert-info">No Blog Posts Yet</div>
					<?php else: ?>
						<div class="row">
							<?php foreach($allPublishedArticles as $article): ?>
							   <?php require VIEWS_PATH . DS . 'blog' . DS . 'partials' . DS . 'listings.php'; ?>
						    <?php endforeach; ?>
						</div>
						<?php if(isset($pagination)): ?>
							<div class="d-flex justify-content-between align-items-center border-top pt-3 pb-4">
								<div class="text-muted">
									Showing <?= count($allPublishedArticles); ?> of <?= $pagination->totalCount; ?> items
								</div>
			                    <?php require VIEWS_PATH . DS . 'blog' . DS . 'pagination' . DS . 'index.php'; ?>
			                </div>
		                <?php endif; ?>
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