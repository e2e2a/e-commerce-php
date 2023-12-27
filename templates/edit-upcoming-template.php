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
                    <a href="#">Upcoming Product</a>
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
                <h3 class="mb-30">Update Upcoming Product</h3>
                <form class="contact_form" action="" method="post" enctype="multipart/form-data">
                    <div class="mt-10">
                        <input type="text" name="product_name" placeholder="Product Name" required
                            class="single-input-primary" value="<?php echo $results['product_name']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="number" name="price" placeholder="Price" required class="single-input-primary"
                            value="<?php echo $results['price']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="int" name="quantity" placeholder="Quantity" required class="single-input-primary"
                            value="<?php echo $results['quantity']; ?>">
                    </div>
                    <div class="input-group-icon mt-10">
                        <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                        <div class="form-select" id="default-select">
                            <select name="category">
                                <option value="Sneakers"
                                    <?php echo ($results['category'] === 'Sneakers') ? 'selected' : ''; ?>>Sneakers
                                </option>
                                <option value="Ballet flats"
                                    <?php echo ($results['category'] === 'Ballet flats') ? 'selected' : ''; ?>>Ballet
                                    flats</option>
                                <option value="Kitten heels"
                                    <?php echo ($results['category'] === 'Kitten heels') ? 'selected' : ''; ?>>Kitten
                                    heels</option>
                                <option value="Sandals"
                                    <?php echo ($results['category'] === 'Sandals') ? 'selected' : ''; ?>>Sandals
                                </option>
                                <option value="Beach Shoes"
                                    <?php echo ($results['category'] === 'Beach Shoes') ? 'selected' : ''; ?>>Beach
                                    Shoes</option>
                                <option value="Flip flops"
                                    <?php echo ($results['category'] === 'Flip flops') ? 'selected' : ''; ?>>Flip flops
                                </option>
                                <option value="Hiking boots"
                                    <?php echo ($results['category'] === 'Hiking boots') ? 'selected' : ''; ?>>Hiking
                                    boots</option>
                                <option value="Moccasin"
                                    <?php echo ($results['category'] === 'Moccasin') ? 'selected' : ''; ?>>Moccasin
                                </option>
                                <option value="Platform shoe"
                                    <?php echo ($results['category'] === 'Platform shoe') ? 'selected' : ''; ?>>Platform
                                    shoe</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-10">
                        <textarea class="single-textarea single-input-primary" name="description"
                            placeholder="Description" required><?php echo $results['description']; ?></textarea>
                    </div>
                    <div class="mt-10">
                        <input type="text" name="width" placeholder="Width" required class="single-input-primary"
                            value="<?php echo $results['width']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="text" name="height" placeholder="Height" required class="single-input-primary"
                            value="<?php echo $results['height']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="text" name="depth" placeholder="Depth" required class="single-input-primary"
                            value="<?php echo $results['depth']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="text" name="weight" placeholder="Weight" required class="single-input-primary"
                            value="<?php echo $results['weight']; ?>">
                    </div>
                    <div class="mt-10">
                        <input type="file" name="images" class="single-input-primary">
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