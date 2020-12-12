<?php if (isset($room) && $room != false) : ?>
<div class="card">
  <div class="card-header">
    Edit <strong>Room</strong>
  </div>
  <div class="card-body card-block">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

      <div class="row form-group">
        <div class="col col-md-3"><label for="room-number" class=" form-control-label">Room Number</label></div>
        <div class="col-12 col-md-9">
          <input type="number" name="room-number" placeholder="<?= $room->room_number ?>" class="form-control"><small class="form-text text-muted">Please enter the room number.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="room-type" class=" form-control-label">Room Type</label></div>
        <div class="col-12 col-md-9">
          <?php 
            $singleRoom = $room->room_type == 'single' ? 'selected' : null;
            $doubleRoom = $room->room_type == 'double' ? 'selected' : null;
            $suiteRoom = $room->room_type == 'suite' ? 'selected' : null;
          ?>
          <select name="room-type" id="select" class="form-control">
              <option <?= $singleRoom ?> value="single">Single</option>
              <option <?= $doubleRoom ?> value="double">Double</option>
              <option <?= $suiteRoom ?> value="suite">Suite</option>
          </select>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="beds" class=" form-control-label">Beds</label></div>
        <div class="col-12 col-md-9">
          <input type="number" id="text-input" name="beds" placeholder="<?= $room->beds ?>" class="form-control"><small class="form-text text-muted">Please enter the beds number.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="price" class=" form-control-label">Price</label></div>
        <div class="col-12 col-md-9">
          <input type="number" name="price" placeholder="<?= $room->price ?>" class="form-control"><small class="form-text text-muted">Please enter the room's price per night. EGP</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="description" class=" form-control-label">Description</label></div>
        <div class="col-12 col-md-9">
          <textarea id="text-input" name="description" placeholder="<?= $room->description ?>" class="form-control"></textarea><small class="form-text text-muted">Please enter the description.</small>
        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="image" class=" form-control-label">Image</label></div>
          <div class="col-12 col-md-9" id="image-input-form-group">
          
          <?php if ($room->image != " ") : ?>
            <img onclick="replaceImageWithInput('<?= $room->room_id ?>')" id="testimonial-image-element" src="<?= IMAGES_DIR . 'rooms-img/' . $room->image ?>">
          <?php else: ?>
            <input type='file' name='image'/>
          <?php endif; ?>

        </div>
      </div>

      <div class="row form-group">
        <div class="col col-md-3"><label for="status" class=" form-control-label">Room Status</label></div>
        <div class="col-12 col-md-9">
          <?php
            $activeRoom = $room->status == 'active' ? 'selected' : null;
            $inactiveRoom = $room->status == 'inactive' ? 'selected' : null;
          ?>
          <select name="status" id="select" class="form-control">
            <option <?= $activeRoom ?> value="active">Active</option>
            <option <?= $inactiveRoom ?> value="inactive">Inactive (Broken/ Under Construction ..etc)</option>
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

<?php endif; ?>