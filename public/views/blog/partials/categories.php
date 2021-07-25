<h4 class="text-msugreen mb-3">Blog Categories</h4>
<?php if(empty($allCategories)): ?>
	<div class="alert alert-info">No Blog Categories Yet</div>
<?php else: ?>
	<div class="row">
		<?php $groupedCategories = []; ?>
		<?php foreach($allCategories as $category): ?>
			<?php $groupedCategories[ucfirst($category->name)][] = $category; ?>
		<?php endforeach; ?>
		<?php foreach($groupedCategories as $categoryname => $categories): ?>
			<div class="col-12 mb-3">
				<?php $id = empty($categories[0]->id) ? 0 : (int)$categories[0]->id; ?>
				<a href="<?= DOMAIN; ?>/blog/category/<?= $id; ?>/<?= trim(strtolower(str_replace(' ', '', $categoryname))); ?>" class="d-block bg-alabaster py-3 px-3 border-raduis-sm d-flex justify-content-between">
					<div class="text-pumpkin font-weight-bold">
						<?= Bullnet\Core\Help::limitStringLength(ucfirst($categoryname), 14); ?>
					</div>
					<div style="width: 42px; height: 25px; line-height: 25px;" class="bg-skyblue border-0 text-center rounded-pill">
						<small class="text-white">
							<?= !empty($categories) && is_array($categories) ? count($categories) : 0; ?>
						</small>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>