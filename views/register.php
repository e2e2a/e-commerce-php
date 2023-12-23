<?php
include '../database/config.php';
$pageTitle = 'REGISTER | SHOPEE';
?>




<?php
include_once '../templates/partials/header.php';
include_once '../templates/partials/nav-bar.php';
?>


	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Login/Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
                <div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="actions/create-user.php" method="post" id="contactForm">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" required/>
							</div>
                            <div class="col-md-12 form-group">
								<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" required/>
							</div>
                            <div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" required/>
							</div>
                            <div class="col-md-12 form-group">
								<input type="date" class="form-control" id="birthdate" name="birthdate" required/>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" name="create" class="primary-btn">Create</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="../public/img/main/login.jpg" alt="">
						<div class="hover">
							<h4>Already a member?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="login.php">LOG IN TO ENTER</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

<?php
	include_once '../templates/partials/footer.php';
?>