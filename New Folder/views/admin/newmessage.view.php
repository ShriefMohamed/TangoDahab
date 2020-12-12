<div class="card">
  <div class="card-header">
    Send new <strong>Message</strong>
  </div>
  <div class="card-body card-block">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

      <div class="row form-group">
        <div class="col col-md-3"><label for="send-to" class=" form-control-label">Send To</label></div>
        <div class="col-12 col-md-9"><input type="email" id="text-input" name="send-to" placeholder="Send To..." class="form-control"><small class="form-text text-muted">Please enter the email of the person you want to send a message to.</small></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="subject" class=" form-control-label">Subject</label></div>
        <div class="col-12 col-md-9"><input type="text" id="text-input" name="subject" placeholder="Subject..." class="form-control"><small class="form-text text-muted">Please enter the subject.</small></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="message" class=" form-control-label">Message</label></div>
        <div class="col-12 col-md-9"><textarea name="message" id="textarea-input" rows="9" placeholder="Message..." class="form-control"></textarea></div>
      </div>

  	  <div class="card-footer">
  	    <button type="submit" class="btn btn-primary btn-sm" name="send">
  	      <i class="fa fa-dot-circle-o"></i> Submit
  	    </button>
  	    <button type="reset" class="btn btn-danger btn-sm">
  	      <i class="fa fa-ban"></i> Reset
  	    </button>
  	  </div>
    </form>
	</div>
</div>

