<?php use Framework\Models\RoomsModel; ?>
<script>
  const monthNames = [
            "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
        ];
</script>
<!-- ##### Book Now Area Start ##### -->
<div class="book-now-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="book-now-form">
                    <form method="post">
                        <!-- Form Group -->
                        <?php $date = date('m/d/Y'); ?>
                        <div class="form-group">
                            <label for="select1">Check In</label>
                            <select class="form-control" id="select1">
                              <?php for ($i = 0; $i < 7; $i++) : ?>
                                <option><?= date('F d',strtotime($date . "+".$i." days")); ?></option>
                              <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label for="select2">Check Out</label>
                            <select class="form-control" id="select2">
                              <?php for ($j = 1; $j < 8; $j++) : ?>
                                <option><?= date('F d',strtotime($date . "+".$j." days")); ?></option>
                              <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label for="select3">Guests</label>
                            <select class="form-control" id="select3">
                              <option value="1">1 Guest</option>
                              <option value="2">2 Guests</option>
                              <option value="3">3 Guests</option>
                              <option value="4">4 Guests</option>
                              <option value="5">+5 Guests</option>
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <label for="select4">Room</label>
                            <?php $roomss = RoomsModel::getAll(" WHERE status = 'active' LIMIT 3 "); ?>
                            <?php if ($roomss != false && $roomss != null) : ?>
                                <select class="form-control" id="select4">
                                <?php foreach ($roomss as $room) : ?>
                                  <option value="<?= $room->room_id ?>" ><?= $room->room_number . ' - ' . ucfirst($room->room_type) ?></option>
                                <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                            <select class="form-control" id="select4">
                                <option value="0">No Rooms Available</option>
                            </select>
                            <?php endif; ?>

                        </div>

                        <!-- Button -->
                        <button type="button" onclick="Reservation('1')">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Book Now Area End ##### -->
