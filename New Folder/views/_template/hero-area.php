<?php use Framework\Models\Manage_websiteModel; ?>
<?php 
    $aboutus1 = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus1' LIMIT 1");
    $aboutus1 = ($aboutus1) ? array_shift($aboutus1) : null;
    $aboutus2 = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus2' LIMIT 1");
    $aboutus2 = ($aboutus2) ? array_shift($aboutus2) : null;
    $aboutus3 = Manage_websiteModel::getAll(" WHERE setting = 'home-aboutus3' LIMIT 1");
    $aboutus3 = ($aboutus3) ? array_shift($aboutus3) : null;
?>
<!-- ##### Hero Area Start ##### -->
<section class="hero-area">
    <div class="hero-slides owl-carousel">

        <?php if (isset($aboutus1) && $aboutus1 != null) : ?>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url(<?= IMAGES_DIR . 'bg-img/' . $aboutus1->image ?>);"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <!-- Slide Content -->
                        <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                            <div class="line" data-animation="fadeInUp" data-delay="300ms"></div>
                            <h2 data-animation="fadeInUp" data-delay="500ms">The Vacation Heaven</h2>
                            <p data-animation="fadeInUp" data-delay="700ms"><?= $aboutus1->content ?></p>
                            <a href="<?= HOST_NAME ?>index/aboutus" class="btn palatin-btn mt-50" data-animation="fadeInUp" data-delay="900ms">More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($aboutus2) && $aboutus2 != null) : ?>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url(<?= IMAGES_DIR . 'bg-img/' . $aboutus2->image ?>);"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <!-- Slide Content -->
                        <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                            <div class="line" data-animation="fadeInUp" data-delay="300ms"></div>
                            <h2 data-animation="fadeInUp" data-delay="500ms">A place to remember</h2>
                            <p data-animation="fadeInUp" data-delay="700ms"><?= $aboutus2->content ?></p>
                            <a href="<?= HOST_NAME ?>index/aboutus" class="btn palatin-btn mt-50" data-animation="fadeInUp" data-delay="900ms">More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($aboutus3) && $aboutus3 != null) : ?>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url(<?= IMAGES_DIR . 'bg-img/' . $aboutus3->image ?>);"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <!-- Slide Content -->
                        <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                            <div class="line" data-animation="fadeInUp" data-delay="300ms"></div>
                            <h2 data-animation="fadeInUp" data-delay="500ms">Enjoy your life</h2>
                            <p data-animation="fadeInUp" data-delay="700ms"><?= $aboutus3->content ?></p>
                            <a href="<?= HOST_NAME ?>index/aboutus" class="btn palatin-btn mt-50" data-animation="fadeInUp" data-delay="900ms">More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>
<!-- ##### Hero Area End ##### -->

