<div class="bg-mintcream min-vh-100" style="padding: 50px 0 20px 0;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4 mb-4">
				<div class="">
					<h2 class="text-blueviolet pb-2">Reset Password</h2>
					<form action="javascript:;" method="post" class="password-reset-form" data-action="<?= DOMAIN; ?>/password/reset" autocomplete="off">
						<div class="mb-3">
							<label for="" class="mb-2">
							    <span class="text-muted">Reset Token</span>
							</label>
							<div class="input-group input-group-lg">
								<div class="input-group-prepend">
                                    <span class="input-group-text text-blueviolet" style="background-color: var(--mintcream) !important;">
                                    	<i class="icofont-code"></i>
                                    </span>
                                </div>
                                <input type="text" name="token" class="form-control form-control-lg token" placeholder="e.g., hb387d6j4h3o">
							</div>
							<small class="error token-error text-danger"></small>
						</div>
						<div class="mb-3">
							<label for="" class="mb-2">
							    <span class="text-muted">Password</span>
							</label>
							<div class="input-group input-group-lg">
								<div class="input-group-prepend">
                                    <span class="input-group-text text-blueviolet" style="background-color: var(--mintcream) !important;">
                                    	<i class="icofont-lock"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
							</div>
							<small class="error password-error text-danger"></small>
						</div>
						<div class="mb-3">
							<label for="" class="mb-2">
							    <span class="text-muted">Confirm Password</span>
							</label>
							<div class="input-group input-group-lg">
								<div class="input-group-prepend">
                                    <span class="input-group-text text-blueviolet" style="background-color: var(--mintcream) !important;">
                                    	<i class="icofont-lock"></i>
                                    </span>
                                </div>
                                <input type="password" name="confirmpassword" class="form-control form-control-lg confirmpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
							</div>
							<small class="error confirmpassword-error text-danger"></small>
						</div>
						<div class="alert mt-4 px-3 password-reset-message d-none"></div>
						<button type="submit" class="btn mt-4 btn-lg btn-block border-0 bg-blueviolet text-white password-reset-button">
							<img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none password-reset-spinner mb-1">
							Reset
						</button>
					</form>
					<a href="" class="text-muted d-block mt-3 text-decoration-underline">Did'nt get a token?</a>
				</div>
			</div>
		</div>
	</div>
</div>