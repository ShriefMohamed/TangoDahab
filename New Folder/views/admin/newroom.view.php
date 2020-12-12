<div class="card">
  <div class="card-header">
    Add new <strong>Room</strong>
  </div>
  <div class="card-body card-block">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

      <div class="row form-group">
        <div class="col col-md-3"><label for="room-number" class=" form-control-label">Room Number</label></div>
        <div class="col-12 col-md-9">
          <input type="number" name="room-number" placeholder="Room Number" class="form-control"><small class="form-text text-muted">Please enter the room number.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="room-type" class=" form-control-label">Room Type</label></div>
        <div class="col-12 col-md-9">
          <select name="room-type" id="select" class="form-control">
              <option value="single">Single</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="beds" class=" form-control-label">Beds</label></div>
        <div class="col-12 col-md-9">
          <input type="number" id="text-input" name="beds" placeholder="Beds..." class="form-control"><small class="form-text text-muted">Please enter the beds number.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="price" class=" form-control-label">Price</label></div>
        <div class="col-12 col-md-9">
          <input type="number" name="price" placeholder="Price" class="form-control"><small class="form-text text-muted">Please enter the room's price per night. EGP</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="description" class=" form-control-label">Description</label></div>
        <div class="col-12 col-md-9">
          <textarea id="text-input" name="description" placeholder="Description..." class="form-control"></textarea><small class="form-text text-muted">Please enter the description.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="image" class=" form-control-label">Image</label></div>
        <div class="col-12 col-md-9">
          <input type="file" name="image"><small class="form-text text-muted">Please choose an Picture.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="status" class=" form-control-label">Room Status</label></div>
        <div class="col-12 col-md-9">
          <select name="status" id="select" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive (Broken/ Under Construction ..etc)</option>
          </select>
        </div>
      </div>

  	  <div class="card-footer">
  	    <button type="submit" name="submit" class="btn btn-primary btn-sm">
  	      <i class="fa fa-dot-circle-o"></i> Submit
  	    </button>
  	    <button type="reset" class="btn btn-danger btn-sm">
  	      <i class="fa fa-ban"></i> Reset
  	    </button>
  	  </div>
    </form>
  </div>
</div>

