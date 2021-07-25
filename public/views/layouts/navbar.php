<?php use Bullnet\Library\Authenticated; ?>
<!-- <div class="fixed-top navigation-bar-fixed-top bg-transparent gray-border-bottom"> -->
<div class="fixed-top bg-white">
	<div class="container">
		<div class="navbar py-4 px-0 d-flex align-items-center justify-content-between">
			<a href="<?= DOMAIN; ?>/" class="">
				<img src="<?= PUBLIC_URL; ?>/images/logos/large.png" class="img-fluid object-fit-cover">
			</a>
			<div class="navbar-links d-flex justify-content-center">
				<ul class="d-flex align-items-center navbar-links-list">
					<li class="ml-4">
						<a href="<?= DOMAIN; ?>/" class="text-blueviolet">Home</a>
					</li>
					<li class="ml-4">
						<a href="<?= DOMAIN; ?>/pricing" class="text-blueviolet">Pricing</a>
					</li>
					<li class="ml-4">
						<a href="<?= DOMAIN; ?>/about" class="text-blueviolet">About</a>
					</li>
					<li class="ml-4">
						<a href="<?= DOMAIN; ?>/blog" class="text-blueviolet">Blog</a>
					</li>
					<?php if(Authenticated::user()->role === 'admin'): ?>
						<li class="ml-4">
							<a href="<?= DOMAIN; ?>/dashboard" class="text-blueviolet">Dashboard</a>
						</li>
					<?php endif; ?>
					<?php if(Authenticated::user()->status === false): ?>
						<li class="ml-4">
							<a href="<?= DOMAIN; ?>/signup" class="text-blueviolet">Signup</a>
						</li>
						<li class="ml-4">
							<a href="<?= DOMAIN; ?>/login" class="text-blueviolet">Login</a>
						</li>
					<?php endif; ?>
					<li class="ml-4">
						<a href="<?= DOMAIN; ?>/contact" class="text-blueviolet">Contact</a>
					</li>
				</ul>
			</div>
			<div class="">
				<ul class="d-flex align-items-center">
					<?php if(Authenticated::user()->status !== true): ?>
					    <li>
					    	<a href="javascript:;">
					    		<i class="icofont-search"></i>
					    	</a>
							<!-- <div class="dropdown cursor-pointer d-block ml-3 text-decoration-none text-center rounded-circle" style="width: 30px; height: 30px; line-height: 30px;">
								<img src="<?= PUBLIC_URL; ?>/images/profiles/<?= empty($user) || empty($user->picture) ? 'default.png' : $user->picture; ?>" class="img-fluid border rounded-circle w-100 h-100" id="user-profile-menu" data-toggle="dropdown">
								<div class="dropdown-menu border-0 dropdown-menu-right shadow" aria-labelledby="user-profile-menu">
									<a class="dropdown-item font-weight-bolder" href="javascript:;">My Profile</a>
									<div class="dropdown-divider"></div>
								    <a class="dropdown-item text-muted" href="javascript:;">Change Picture</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item text-muted" href="javascript:;">Update Password</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item text-muted logout-link" href="javascript:;" data-url="<?= DOMAIN; ?>/login/logout">Logout Here</a>
								</div>
							</div> -->
					    </li>
				    <?php endif; ?>
				    <li>
						<div class="hanburger-icon ml-3 position-relative p-md-0 d-flex justify-content-end align-items-center cursor-pointer">
							<div class="icon-lines"></div>
						</div>
				    </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bg-blueviolet">
		<div class="container">
			<div class="py-3 text-white">For managers</div>
		</div>
	</div>
</div>
<div class="navbar-menu shadow no-gutters bg-light position-fixed vh-100">
	<div class="menu-content vh-100 px-4 mt-4">
		<div class="mb-2">
			<a href="<?= DOMAIN; ?>" class="text-muted d-block">Home</a>
		</div>
		<div class="mb-2">
			<a href="<?= DOMAIN; ?>/about" class="text-muted d-block">About</a>
		</div>
		<div class="mb-2">
			<a href="<?= DOMAIN; ?>/blog" class="text-muted d-block">Blog</a>
		</div>
		<?php if(Authenticated::user()->role === 'admin'): ?>
			<div class="mb-2">
				<a href="<?= DOMAIN; ?>/dashboard" class="text-muted d-block">Dashboard</a>
			</div>
		<?php endif; ?>
		<?php if(Authenticated::user()->status === false): ?>
			<div class="mb-2">
				<a href="<?= DOMAIN; ?>/login" class="text-muted d-block">Login</a>
			</div>
			<div class="mb-2">
				<a href="<?= DOMAIN; ?>/signup" class="text-muted d-block">Signup</a>
			</div>
		<?php endif; ?>
	</div>
</div>