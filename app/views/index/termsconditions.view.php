<?php if (isset($termsconditions) && $termsconditions != null) : ?>
<!-- Contact Us -->
<div class="contact-us container-fluid no-padding">
	<br>
	<!-- Container -->
	<div class="container">
		<div class="col-12 col-lg-6">
            <div class="about-text mb-100">
                <div class="section-heading">
                    <div class="line-"></div>
                    <h2>Terms & Conditions</h2>
                </div>
                <p><?= $termsconditions->content ?></p>
            </div>
        </div>

	</div><!-- Container /- -->
	<div class="section-padding"></div>
</div><!-- Contact Us /- -->
<?php endif; ?>