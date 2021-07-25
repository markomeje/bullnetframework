<?php $totalPages  = $pagination->totalPages();?>
<?php if($totalPages > 1): ?>
	<div class="row mx-0">
		<div class="col-12 px-0">
			<?php $currentPage = $pagination->currentPage; $link = DOMAIN.'/blog/page'; ?>
		  	<ul class="d-flex align-items-center">
		  		<?php if($pagination->hasPreviousPage() === true): ?>
		  			<li class="mr-3">
				        <a class="pagination-link text-decoration-none d-block text-center rounded-circle text-white bg-pumpkin" href="<?= $pagination->previousPage() === 1 ? $link : $link.'/'.$pagination->previousPage(); ?>">
				        	<small><i class="icofont-arrow-left"></i></small>
				        </a>
				    </li>
				<?php endif; ?>
				<?php $visiblePages = ($currentPage - 1) > 2 ? ($currentPage - 1) : 2; ?>
		        <?php $pageEnd = ($currentPage + 1) < $totalPages ? ($currentPage + 1) : $totalPages; ?>
			    <?php for($page = $visiblePages; $page < $pageEnd; $page++): ?>
					<li class="">
				        <a class="pagination-link mr-3 text-decoration-none d-block text-white text-center rounded-circle bg-skyblue" href="<?= $link.'/'.$page; ?>">
				        	<small><?= $page; ?></small>
				        </a>
					</li>
				<?php endfor; ?>
				<?php if($pagination->hasNextPage() === true): ?>
		  			<li class="">
				        <a class="pagination-link text-decoration-none d-block text-center rounded-circle text-white bg-pumpkin" href="<?= $link.'/'.$pagination->nextPage(); ?>">
				        	<small><i class="icofont-arrow-right"></i></small>
				        </a>
				    </li>
				<?php endif; ?>
		  	</ul>
		</div>
	</div>
<?php endif; ?>
