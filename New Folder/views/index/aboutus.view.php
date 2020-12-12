    <?php if (isset($aboutus) && $aboutus != null) : ?>
    <!-- ##### About Us Area Start ##### -->
    <section class="about-us-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="about-text mb-100">
                        <div class="section-heading">
                            <div class="line-"></div>
                            <h2>A place to remember</h2>
                        </div>
                        <p><?= $aboutus->content ?></p>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-thumbnail mb-100">
                        <img src="<?= IMAGES_DIR . 'bg-img/' . $aboutus->image ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->
    <?php endif; ?>


    <!-- ##### Milestones Area Start ##### -->
    <section class="our-milestones section-padding-100-0 bg-img bg-overlay bg-fixed" style="background-image: url(<?= IMAGES_DIR ?>bg-img/bg-4.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="section-heading text-center white">
                        <div class="line-"></div>
                        <h2>Our Milestones</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum.</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <div class="scf-text">
                            <i class="icon-cocktail-1"></i>
                            <h2><span class="counter">231</span></h2>
                            <p>Cocktails/day</p>
                        </div>
                    </div>
                </div>

                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <div class="scf-text">
                            <i class="icon-swimming-pool"></i>
                            <h2><span class="counter">3</span></h2>
                            <p>Pools</p>
                        </div>
                    </div>
                </div>

                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="scf-text">
                            <i class="icon-resort"></i>
                            <h2><span class="counter">79</span></h2>
                            <p>Rooms</p>
                        </div>
                    </div>
                </div>

                <!-- Single Cool Facts -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact mb-100 wow fadeInUp" data-wow-delay="900ms">
                        <div class="scf-text">
                            <i class="icon-restaurant"></i>
                            <h2><span class="counter">25</span></h2>
                            <p>Apartments</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### Milestones Area End ##### -->

    <!-- ##### Services Area Start ##### -->
    <section class="services-area section-padding-100-0">
        <div class="container">
            <div class="row">

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <i class="icon-resort"></i>
                        <h4>Luxury Rooms</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="200ms">
                        <i class="icon-boat"></i>
                        <h4>Fast & Free Wifi</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="300ms">
                        <i class="icon-restaurant"></i>
                        <h4>Restaurant</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="400ms">
                        <i class="icon-beach"></i>
                        <h4>Call Us 24/7</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="500ms">
                        <i class="icon-boarding-pass"></i>
                        <h4>Travel Accomodation</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

                <!-- Single Service Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-service-area mb-50 wow fadeInUp" data-wow-delay="600ms">
                        <i class="icon-sign"></i>
                        <h4>Hiking</h4>
                        <p>Nulla massa dui, posuere non erat in, eleifend mattis dui. Vivamus luctus luctus rhoncus. Donec sagittis nulla id finibus iaculis. Mauris odio tortor.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ##### Services Area End ##### -->


    <?php if (isset($testimonials) && $testimonials != null) : ?>
    <!-- ##### Testimonial Area Start ##### -->
    <section class="testimonial-area section-padding-100 bg-img" style="background-image: url(<?= IMAGES_DIR ?>core-img/pattern.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-content">
                        <div class="section-heading text-center">
                            <div class="line-"></div>
                            <h2>What Clients Say</h2>
                        </div>
                        
                        <!-- Testimonial Slides -->
                        <div class="testimonial-slides owl-carousel">
                            <?php foreach ($testimonials as $testimonial) : ?>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial">
                                <p><?= $testimonial->review ?></p>
                                <h6><?= $testimonial->name ?>, <span><?= $testimonial->position ?></span></h6>
                                <img src="<?= IMAGES_DIR . 'testimonial-img/' . $testimonial->image ?>" alt="">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Testimonial Area End ##### -->
    <?php endif; ?>