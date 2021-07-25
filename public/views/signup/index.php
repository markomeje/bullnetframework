<div class="">
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'navbar.php'; ?>
	<div class="" style="padding: 200px 0 80px;">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-md-8 col-lg-6 mb-4">
					<div class="">
						<h2 class="text-blueviolet pb-2">Signup Here</h2>
						<p class="text-muted">Please Fill In All Fields.</p>
						<form action="javascript:;" method="post" class="signup-form" data-action="<?= DOMAIN; ?>/signup" autocomplete="off">
							<div class="form-row">
								<div class="form-group input-group-lg col-md-6">
									<label for="" class="text-muted mb-2">Email</label>
									 <input type="email" name="email" class="form-control form-control-lg email" placeholder="e.g., john@doe.com">
									 <small class="error email-error text-danger"></small>
								</div>
								<div class="form-group input-group-lg col-md-6">
									<label for="" class="text-muted mb-2">Phone</label>
									 <input type="text" name="phone" class="form-control form-control-lg phone" placeholder="e.g., 09011112113">
									 <small class="error phone-error text-danger"></small>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group input-group-lg col-md-6">
									<label for="" class="mb-2 text-muted">Password
									</label>
									<input type="password" name="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
									<small class="error password-error text-danger"></small>
								</div>
								<div class="form-group input-group-lg col-md-6">
									<label for="" class="mb-2 text-muted">Confirm Password
									</label>
									<input type="password" name="confirmpassword" class="form-control form-control-lg confirmpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
									<small class="error confirmpassword-error text-danger"></small>
								</div>
							</div>
							<button type="submit" class="btn mt-2 btn-lg border-0 bg-blueviolet text-white signup-button">
								<img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none signup-spinner mb-1">
								Signup
							</button>
							<div class="alert mt-4 px-3 signup-message d-none"></div>
						</form>
					</div>
				</div>
				<div class="col-12 col-md-4 col-lg-6 mb-4">
					<div class="">
						<img src="<?= PUBLIC_URL; ?>/images/banners/rocket.png" class="img-fluid w-100">
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require VIEWS_PATH . DS . 'layouts' . DS . 'bottom.php'; ?>
</div>