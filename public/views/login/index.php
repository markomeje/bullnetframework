<div class="bg-mintcream min-vh-100" style="padding: 50px 0 20px 0;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4 mb-4">
				<div class="">
					<h2 class="text-blueviolet m-0 pb-2">Login Here</h2>
					<form action="javascript:;" method="POST" class="login-form mb-3" data-action="<?= DOMAIN; ?>/login" autocomplete="off">
						<div class="alert my-3 px-3 login-message d-none"></div>
						<div class="mb-3">
							<label class="text-muted mb-2">Email</label>
							<div class="input-group">
								<div class="input-group-prepend">
                                    <span class="input-group-text shadow-sm text-blueviolet" style="background-color: var(--mintcream);">
                                    	<i class="icofont-email"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" class="form-control email" placeholder="e.g., john@doe.com">
							</div>
							<small class="error email-error text-danger"></small>
						</div>
						<div class="mb-3">
							<label class="mb-2">
							    <span class="text-muted">Password</span>
							</label>
							<div class="input-group">
								<div class="input-group-prepend">
                                    <span class="input-group-text shadow-sm text-blueviolet" style="background-color: var(--mintcream);">
                                    	<i class="icofont-lock"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
							</div>
							<small class="error password-error text-danger"></small>
						</div>
						<div class="">
							<div class="custom-control custom-switch">
							    <input type="checkbox" class="custom-control-input" id="rememberme" value="on" name="rememberme">
							    <label class="custom-control-label cursor-pointer text-muted" for="rememberme">Remember Login</label>
							</div>
						</div>
						<button type="submit" class="btn mt-4 btn-lg border-0 btn-block bg-blueviolet text-white login-button border-raduis-lg">
							<img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none login-spinner mb-1">
							Login
						</button>
					</form>
					<?php require VIEWS_PATH . DS . 'password' . DS . 'process.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>