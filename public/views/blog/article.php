<div class="wrapper">
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'frontend' . DS . 'navbar.php'; ?>
	<section class="" style="padding: 130px 0 90px;">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9">
					<div class="border-bottom">
						<?php if(empty($article)): ?>
							<div class="alert alert-info mb-4">Blog Article Not Found</div>
						<?php else: ?>
							<div class="row">
								<div class="col-12">
									<div class="card p-0 border-0">
										<div class="">
											<h4 class="text-msugreen">
												<?= empty($article->title) ? 'Nill' : ucwords($article->title); ?>
											</h4>
											<div class="text-muted mb-3">
												<?= empty($article->date) ? 'Nill' : 'Posted '.Bullnet\Core\Help::formatDate($article->date); ?> -
												<?= empty($article->author) ? 'Nill' : '<em>By</em> '.Bullnet\Core\Help::limitStringLength($article->author, 32); ?> 
										    </div>
										</div>
										<div class="">
											<img src="<?= PUBLIC_URL; ?>/images/articles/<?= empty($article->image) ? 'default.jpg' : $article->image; ?>" class="card-img img-fluid object-fit-cover">
										</div>
										<div class="card-body px-0">
											<div class="text-muted mb-3">
												<?= empty($article->content) ? 'Nill' : $article->content; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="">
						<div class="bg-alabaster p-3 my-4 border-raduis-sm text-msugreen">
							<div>Comments</div>
						</div>
						<?php if(empty($articleComments)): ?>
							<div class="alert alert-info">No Comments For this Article</div>
						<?php else: ?>
							<div class="row">
								<?php foreach ($articleComments as $comment): ?>
									<div class="col-12 mb-4">
										<div class="border p-3 border-raduis-sm">
											<div class="">
												<?= empty($comment->commentbox) ? '' : $comment->commentbox; ?>
											</div>
											<div class="d-flex align-items-center">
												<div class="mr-2" style="width: 20px; height: 20px;">
													<img src="<?= PUBLIC_URL; ?>/images/profiles/<?= empty($comment->picture) ? 'default.png' : $comment->picture; ?>" class="img-fluid border w-100 h-100 rounded-circle">
												</div>
												<small class="text-muted mt-2">
													<?= ucfirst($comment->firstname); ?> (<?= Bullnet\Library\Timeago::make($comment->date); ?>)
												</small>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						<?php endif; ?>
						<div class="mb-4">
							<form class="commentbox-form" action="javascript:;" method="post" data-action="<?= DOMAIN; ?>/comments/add/<?= $articleid; ?>">
								<div class="form-group">
									<label class="text-muted mb-2">Comments</label>
									<textarea class="form-control commentbox" name="commentbox" placeholder="Type Your Comment Here" rows="4"></textarea>
									<small class="error commentbox-error text-danger"></small>
								</div>
								<button type="submit" class="btn mt-2 btn-lg border-0 bg-pumpkin text-white commentbox-button">
									<img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none commentbox-spinner mb-1">
									Comment
								</button>
								<div class="alert mt-4 px-3 commentbox-message d-none"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<?php require VIEWS_PATH . DS . 'blog' . DS . 'partials' . DS . 'categories.php'; ?>
				</div>
			</div>
		</div>
	</section>
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'frontend' . DS . 'footer.php'; ?>
</div>