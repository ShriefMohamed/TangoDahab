
		<!-- Page Banner -->
		<div class="page-banner container-fluid no-padding">
			<div class="page-banner-content">
				<h3>Contact Us</h3>
			</div>
		</div><!-- Page Banner /- -->
		
		<!-- Contact Us -->
		<div class="contact-us container-fluid no-padding">

			<div class="section-padding"></div>
			
			<!-- Container -->
			<div class="container">
				<div class="col-md-6 col-sm-6 col-xs-6 contact-form">
					<!-- Section Header -->
					<div class="section-header">
						<h3>get in touch with us</h3>
					</div><!-- Section Header /- -->
					<form id="contact-form" class="row" method="post">
						<div class="form-group col-md-6 col-sm-6 col-xs-6">
							<label>Your Name *</label>
							<input type="text" class="form-control" id="input_name" name="contact-name" required>
						</div>
						<div class="form-group col-md-6 col-sm-6 col-xs-6">
							<label>Your Email *</label>
							<input type="email" class="form-control" id="input_email" name="contact-email" required>
						</div>
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label>Subject</label>
							<input type="text" class="form-control" id="input_subject" name="contact-subject" required>
						</div>
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label>Your Message</label>
							<textarea class="form-control" rows="8" id="textarea_message" name="contact-message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" title="Send a message"  value="Send a message" name="send">
						</div>
						<div id="alert-msg" class="alert-msg"></div>
					</form>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-6 contact-detail">
					<!-- Section Header -->
					<div class="section-header">
						<h3>Contact Information</h3>
					<p>If you have a question about buying, selling, letting or renting - (or anything else remotely related) - we'd love to help you out</p>
					</div><!-- Section Header /- -->
					<?php if (isset($contactInfo) && $contactInfo != null) : ?>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6 contact-content">
								<div class="contact-info">
									<span class="icon icon-Pointer"></span>
									<p><?= $contactInfo->address ?></p>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 contact-content">
								<div class="contact-info">
									<span class="icon icon-Mail"></span>
									<p><a href="mailto:<?= $contactInfo->email ?>" title="<?= $contactInfo->email ?>"><?= $contactInfo->email ?></a></p>

								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 contact-content">
								<div class="contact-info">
									<span class="icon icon-Phone"></span>
									<p>Call Us  <?= $contactInfo->phone ?></p>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 contact-content">
								<div class="contact-info">
									<span class="icon icon-Phone"></span>
									<p>Free standard shipping on all orders</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div><!-- Container /- -->
			<div class="section-padding"></div>
		</div><!-- Contact Us /- -->
