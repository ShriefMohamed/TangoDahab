<div class="card">
    <div class="card-header">
        Add new <strong>Reservation</strong>
    </div>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

            <div class="row form-group">
                <div class="col col-md-3"><label for="check_in" class=" form-control-label">Arrival Date</label></div>
                <div class="col-12 col-md-9">
                    <input onchange="CalcTotal()" type='date' placeholder="dd/mm/yyyy" name="check_in" class="form-control reservation_date" id='arrival_date' required autocomplete="off" />
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="check_out" class=" form-control-label">Departure Date</label></div>
                <div class="col-12 col-md-9">
                    <input onchange="CalcTotal()" type='date' placeholder="dd/mm/yyyy" name="check_out" class="form-control reservation_date" id='departure_date' required autocomplete="off" />
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="room" class=" form-control-label">Room</label></div>
                <div class="col-12 col-md-9">
                    <select name="room_id" id="room" class="form-control" onchange="CalcTotal()">
                        <?php if (isset($rooms) && $rooms != false) : ?>
                            <?php foreach ($rooms as $room) : ?>
                                <option value="<?= $room->room_id ?>"><?= 'Room #' . $room->room_number . ' - ' . ucfirst($room->room_type) . ' '. $room->price . 'EGP' ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="guests" class=" form-control-label">Guests</label></div>
                <div class="col-12 col-md-9">
                    <select name="guests" id="select" class="form-control">
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                        <option value="5">+5 Guests</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="total" class=" form-control-label">Total</label></div>
                <div class="col-12 col-md-9">
                    <input type="text" id="total" disabled name="total" placeholder="Total..." class="form-control">
                </div>
            </div>


            <div class="row form-group">
                <div class="col col-md-3"><label for="email" class=" form-control-label">Email</label></div>
                <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email Address" class="form-control" required></div>
            </div>

            <div class="row form-group">
                <div class="col col-md-3"><label for="note" class=" form-control-label">Note</label></div>
                <div class="col-12 col-md-9">
                    <textarea id="text-input" name="note" placeholder="Note..." class="form-control"></textarea>
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

