<body>
	<?php
		$current_page = basename($_SERVER['PHP_SELF']);
	?>
	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php"><img src="../public/img/main/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item <?php echo ($current_page === 'index.php') ? 'active' : ''; ?>"><a class="nav-link " href="index.php">Home</a></li>
							<li class="nav-item submenu dropdown <?php echo (in_array($current_page, ['category.php', 'single-product.php', 'checkout.php', 'cart.php', 'confirmation.php'])) ? 'active' : ''; ?>">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="category.php">Shop Category</a></li>
									<li class="nav-item"><a class="nav-link" href="single-product.php">Product Details</a></li>
									<li class="nav-item"><a class="nav-link" href="checkout.php">Product Checkout</a></li>
									<li class="nav-item"><a class="nav-link" href="cart.php">Shopping Cart</a></li>
									<li class="nav-item"><a class="nav-link" href="confirmation.php">Confirmation</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown <?php echo (in_array($current_page, ['blog.php', 'single-blog.php'])) ? 'active' : ''; ?>">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="single-blog.php">Blog Details</a></li>
								</ul>
							</li>
							
							
							<li class="nav-item <?php echo ($current_page === 'contact.php') ? 'active' : ''; ?>"><a class="nav-link" href="contact.php">Contact</a></li>
							<?php
								if(isset($_SESSION['id'])){
									echo '<li class="nav-item submenu dropdown ' . (in_array($current_page, ["edit.php"]) ? 'active' : '') . '">
											<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> PROFILE </a>
											<ul class="dropdown-menu">
												<li class="nav-item"><a class="nav-link" href="edit.php">Edit Profile</a></li>
												<li class="nav-item"><a class="nav-link" href="actions/logout.php">Logout</a></li>
											</ul>
										</li>';
								} else{
									echo '<li class="nav-item submenu dropdown' . (in_array($current_page, ["login.php", "register.php"]) ? 'active' : '') . '">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
										aria-expanded="false">Login</a>
										<ul class="dropdown-menu">
											<li class="nav-item active"><a class="nav-link" href="login.php">Login</a></li>
											<li class="nav-item"><a class="nav-link" href="register.php">Create Account</a></li>
										</ul>
									</li>';
								}
								
							?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>

	<!-- End Header Area -->