<div class="card">
  <div class="card-header">
    Add new <strong>Testimonial</strong>
  </div>
  <div class="card-body card-block">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

      <div class="row form-group">
        <div class="col col-md-3"><label for="name" class=" form-control-label">Full Name</label></div>
        <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Full Name..." class="form-control"><small class="form-text text-muted">Please enter the full name.</small></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="job" class=" form-control-label">Position</label></div>
        <div class="col-12 col-md-9"><input type="text" id="text-input" name="job" placeholder="Position..." class="form-control"><small class="form-text text-muted">Please enter the psosition.</small></div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="review" class=" form-control-label">Review</label></div>
        <div class="col-12 col-md-9"><textarea name="review" id="textarea-input" rows="9" placeholder="Review..." class="form-control"></textarea></div>
      </div>
	
    	<span>Image:</span>
    	<input type="file" name="image" style="position: relative;left: 20.5%"/><br><br>

  	  <div class="card-footer">
  	    <button type="submit" class="btn btn-primary btn-sm">
  	      <i class="fa fa-dot-circle-o"></i> Submit
  	    </button>
  	    <button type="reset" class="btn btn-danger btn-sm">
  	      <i class="fa fa-ban"></i> Reset
  	    </button>
  	  </div>
    </form>
	</div>
</div>

