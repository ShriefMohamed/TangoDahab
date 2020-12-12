    <?php if (isset($aboutus) && $aboutus != null) : ?>    
    <!-- ##### About Us Area Start ##### -->
    <section class="about-us-area">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12 col-lg-6">
                    <div class="about-text text-center mb-100">
                        <div class="section-heading text-center">
                            <div class="line-"></div>
                            <h2>A place to remember</h2>
                        </div>
                        <p><?= substr($aboutus->content, 0, 380); ?></p>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-thumbnail homepage mb-100">
                        <!-- First Img -->
                        <div class="first-img wow fadeInUp" data-wow-delay="100ms">
                            <img src="<?= IMAGES_DIR ?>bg-img/5.jpg" alt="">
                        </div>
                        <!-- Second Img -->
                        <div class="second-img wow fadeInUp" data-wow-delay="300ms">
                            <img src="<?= IMAGES_DIR ?>bg-img/6.jpg" alt="">
                        </div>
                        <!-- Third Img-->
                        <div class="third-img wow fadeInUp" data-wow-delay="500ms">
                            <img src="<?= IMAGES_DIR ?>bg-img/7.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Us Area End ##### -->
    <?php endif; ?>

    <?php if (isset($rooms) && $rooms != false) : ?>
    <!-- ##### Rooms Area Start ##### -->
    <section class="rooms-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="section-heading text-center">
                        <div class="line-"></div>
                        <h2>Choose a room</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <?php foreach ($rooms as $room) : ?>
                <!-- Single Rooms Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-rooms-area wow fadeInUp" data-wow-delay="100ms">
                        <!-- Thumbnail -->
                        <div class="bg-thumbnail bg-img" style="background-image: url(<?= IMAGES_DIR . 'rooms-img/' . $room->image ?>);"></div>
                        <!-- Price -->
                        <p class="price-from">From <?= $room->price ?>EGP/night</p>
                        <!-- Rooms Text -->
                        <div class="rooms-text">
                            <div class="line"></div>
                            <h4><?= ucfirst($room->room_type) ?></h4>
                            <h4><?= $room->beds ?> Beds</h4>
                            <p><?= substr($room->description, 0, 100); ?>...</p>
                        </div>
                        <!-- Book Room -->
                        <input type="hidden" name="room_id" id="room_id" value="<?= $room->room_id ?>">
                        <a href="#" onclick="Reservation(0)" class="book-room-btn btn palatin-btn">Book Room</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ##### Rooms Area End ##### -->
    <?php endif; ?>

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area d-flex flex-wrap align-items-center">
        <div class="home-map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.665719512131!2d34.51728200000001!3d28.494972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x95b2ad605355bba4!2sTango+Camp+Dahab!5e0!3m2!1sen!2seg!4v1551777355972" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <!-- Contact Info -->
        <div class="contact-info">

            <?php if (isset($contactinfo) && $contactinfo != null) : ?>
            <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                <div class="line-"></div>
                <h2>Contact Info</h2>
            </div>
            <h4 class="wow fadeInUp" data-wow-delay="300ms"><?= $contactinfo->address ?></h4>
            <h5 class="wow fadeInUp" data-wow-delay="400ms">+<?= $contactinfo->phone ?></h5>
            <h5 class="wow fadeInUp" data-wow-delay="500ms"><?= $contactinfo->email ?></h5>
            <?php endif; ?>

            <!-- Social Info -->
            <div class="social-info mt-50 wow fadeInUp" data-wow-delay="600ms">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->
