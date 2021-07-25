<div class="dropdown cursor-pointer w-100">
	<div class="text-muted" id="user-process-password-reset-menu" data-toggle="dropdown">Forgot Password?</div>
	<div class="dropdown-menu border-0 shadow w-100" aria-labelledby="user-process-password-reset-menu">
	    <form method="post" class="px-4 pb-4 process-password-reset-form" action="javascript:;" data-action="<?= DOMAIN; ?>/password/process" autocomplete="off">
			<div class="text-muted py-2">Begin Process</div>
			<div class="dropdown-divider"></div>
	    	<div class="alert my-3 px-3 process-password-reset-message d-none"></div>
		    <div class="form-group mb-4">
			    <label class="mb-2 text-muted">Email</label>
			    <input type="email" name="processemail" class="form-control processemail" placeholder="e.g., email@example.com">
			    <small class="error processemail-error text-danger"></small>
		    </div>
		    <button type="submit" class="btn btn-block btn-lg bg-blueviolet text-white process-password-reset-button border-raduis-lg">
			    <img src="<?= PUBLIC_URL; ?>/images/svgs/spinner.svg" class="mr-2 d-none process-password-reset-spinner mb-1">
			    Send
			</button>
		</form>
	</div>
</div>