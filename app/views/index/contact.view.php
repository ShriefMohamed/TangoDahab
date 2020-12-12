<!-- ##### Contact Area Start ##### -->
<section class="contact-information-area">
    <div class="container">
        <div class="row">
            <?php if (isset($contactinfo) && $contactinfo != null) : ?>
            <!-- Single Contact Information -->
            <div class="col-12 col-lg-4">
                <div class="single-contact-information mb-100">
                    <!-- Single Contact Information -->
                    <div class="contact-content d-flex">
                        <p>Address</p>
                        <p><?= $contactinfo->address ?></p>
                    </div>
                    <!-- Single Contact Information -->
                    <div class="contact-content d-flex">
                        <p>Phone</p>
                        <p>+<?= $contactinfo->phone ?></p>
                    </div>
                    <!-- Single Contact Information -->
                    <div class="contact-content d-flex">
                        <p>E-mail</p>
                        <p><?= $contactinfo->email ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->

<!-- ##### Contact Form Area Start ##### -->
<section class="contact-form-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <div class="line-"></div>
                    <h2>Get in touch</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Contact Form -->
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="contact-name" placeholder="Your Name">
                        </div>
                        <div class="col-lg-4">
                            <input type="email" class="form-control" name="contact-email" placeholder="E-mail">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="contact-subject" placeholder="Subject">
                        </div>
                        <div class="col-12">
                            <textarea name="contact-message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="send" class="btn palatin-btn mt-50">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Form Area End ##### -->

<!-- ##### Google Maps ##### -->
<div class="map-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.665719512131!2d34.51728200000001!3d28.494972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x95b2ad605355bba4!2sTango+Camp+Dahab!5e0!3m2!1sen!2seg!4v1551777355972" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
