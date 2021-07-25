<div class="fixed-top bg-white shadow-sm">
	<div class="py-3">
		<div class="container d-flex justify-content-between align-items-center">
			<ul class="d-flex">
				<li class="mr-3">
			    	<a href="<?= DOMAIN; ?>/dashboard" class="text-muted text-decoration-none">
			    		Dashboard
			    	</a>
			    </li>
			</ul>
			<ul class="d-flex align-items-center">
				<li class="mr-3">
					<div class="dropdown">
	                    <div class="cursor-pointer text-muted" id="search-dropdown" data-toggle="dropdown">
	                    	<i class="icofont-search"></i>
	                    </div>
	                    <div class="dropdown-menu border-0 shadow-lg dropdown-menu-right" aria-labelledby="search-dropdown" style="width: 300px;">
	                        <div class="dropdown-item border-0 w-100 d-block">
	                        	<form class="search-form" method="get" action="javascript:;">
	                        		<div class="form-group input-group-lg">
	                        			<input type="text" name="search" class="search-input form-control" placeholder="e.g., Search Here">
	                        		</div>
	                        		<div class="form-group input-group-lg">
	                        			<select class="custom-select form-control">
	                        				<option value="">Select Records</option>
	                        			</select>
	                        		</div>
	                        	</form>
	                        </div>
	                    </div>
	                </div>
			    </li>
			    <li class="mr-3">
			    	<div class="dropdown cursor-pointer d-block text-decoration-none text-center rounded-circle icon-backend-circle">
						<img src="<?= PUBLIC_URL; ?>/images/profiles/<?= empty($user) || empty($user->picture) ? 'default.png' : $user->picture; ?>" class="img-fluid border rounded-circle w-100 h-100" id="user-profile-admin-menu" data-toggle="dropdown">
						<div class="dropdown-menu dropdown-menu-right border-0 shadow" aria-labelledby="user-profile-admin-menu">
							<a class="dropdown-item font-weight-bolder text-blueviolet" href="javascript:;">My Profile</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item text-muted" href="javascript:;">Change Picture</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item text-muted" href="javascript:;">Update Password</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item text-muted logout-link" href="javascript:;" data-url="<?= DOMAIN; ?>/login/logout">Logout Here</a>
						</div>
					</div>
			    </li>
				<li class="cursor-pointer backend-navigation-menu-icon text-muted">
			    	Menu
			    </li>
			</ul>
		</div>
	</div>
</div>

