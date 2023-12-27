<?php
	include_once '../templates/partials/header.php';
	include_once '../templates/partials/nav-bar.php';
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Profile Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="#">Edit<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">User</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
<div class="container-fluid">
<div class="section-top-border mt-5 mb-5"> 
        <div class="row"> 
        <div class="col-lg-12 col-md-12 mb-5">
            <h3 class="mb-30">Update Profile</h3>
            <form class="contact_form" action="" method="post">
                <div class="mt-10">
                    <input type="text" name="username" placeholder="username" required class="single-input" value="<?php echo $results['username']; ?>">
                </div>
                <div class="mt-10">
                    <input type="text" name="fullname" placeholder="Full Name" required class="single-input" value="<?php echo $results['fullname']; ?>">
                </div>
                <div class="mt-10">
                    <input type="email" name="email" placeholder="Email Address" required class="single-input" value="<?php echo $results['email']; ?>">
                </div>
                <div class="mt-10">
                    <input type="date" name="birthdate" placeholder="Birthdate" required class="single-input" value="<?php echo $results['birthdate']; ?>">
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" value="submit" name="submit" class="primary-btn e-large mt-3">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
    
<?php
	include_once '../templates/partials/footer.php';
?>