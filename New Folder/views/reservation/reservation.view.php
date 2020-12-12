<!-- ##### Reservation Area Start ##### -->
<section class="rooms-area section-padding-0-100">
   <div class="container">
      <div class="row justify-content-center">
          <div class="col-12 col-lg-6">
              <div class="section-heading text-center">
                  <div class="line-"></div>
                  <h2>Choose a room</h2>
              </div>
          </div>
      </div>

      <div class="row">
         <div class="col-md-6">
            <form action="" method="post">

              <?php if (isset($_COOKIE['reservation-values']) && !empty($_COOKIE['reservation-values'])) : ?>
                <?php if (json_decode($_COOKIE['reservation-values'])[0] == '1') : ?>
                  <?php if (isset(json_decode($_COOKIE['reservation-values'])[2]) && isset(json_decode($_COOKIE['reservation-values'])[3])) : ?>
                    <script>
                      $( document ).ready(function() {
                        $('#arrival_date').datepicker({dateFormat: "dd/mm/yy" }).val(new Date("<?= json_decode($_COOKIE['reservation-values'])[2] ?>, " + new Date().getFullYear()).toDateString()).trigger('change');
                        $('#departure_date').datepicker({dateFormat: "dd/mm/yy" }).val(new Date("<?= json_decode($_COOKIE['reservation-values'])[3] ?>, " + new Date().getFullYear()).toDateString()).trigger('change');
                      });
                    </script>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>

               <div class="row">
                  <div class="col-sm-6 form-group">
                     <label for="">Arrival Date</label>
                     <div style="position: relative;">
                        <input onchange="CalcTotal()" type='text' placeholder="dd/mm/yyyy" name="check_in" class="form-control reservation_date" id='arrival_date' required autocomplete="off" />
                     </div>
                  </div>

                  <div class="col-sm-6 form-group">
                     <label for="">Departure Date</label>
                     <div style="position: relative;">
                        <input onchange="CalcTotal()" type='text' placeholder="dd/mm/yyyy" name="check_out" class="form-control reservation_date" id='departure_date' required autocomplete="off" />
                     </div>
                  </div>
               </div>


               <div class="row">
                  <div class="col-md-6 form-group">
                     <label for="room">Room</label>
                     <?php if (isset($rooms) && $rooms != false) : ?>
                        <select name="room_id" id="room" class="form-control" required onchange="ChangeFeaturedRoom(); CalcTotal()">
                           <?php foreach ($rooms as $room) : ?>

                            <?php if (isset($_COOKIE['reservation-values']) && !empty($_COOKIE['reservation-values'])) : ?>

                              <?php if (isset(json_decode($_COOKIE['reservation-values'])[1])) : ?>
                                
                                <?php if (json_decode($_COOKIE['reservation-values'])[1] == $room->room_id) : ?>
                                  <option selected value="<?= $room->room_id ?>"><?= 'Room #' . $room->room_number . ' - ' . ucfirst($room->room_type) ?></option>  
                                <?php else : ?>
                                  <option value="<?= $room->room_id ?>"><?= 'Room #' . $room->room_number . ' - ' . ucfirst($room->room_type) ?></option>
                                <?php endif; ?>

                              <?php else : ?>
                                <option value="<?= $room->room_id ?>"><?= 'Room #' . $room->room_number . ' - ' . ucfirst($room->room_type) ?></option>
                              <?php endif; ?>

                            <?php else : ?>
                              <option value="<?= $room->room_id ?>"><?= 'Room #' . $room->room_number . ' - ' . ucfirst($room->room_type) ?></option>
                            <?php endif; ?>

                           <?php endforeach; ?>
                        </select>
                     <?php endif; ?>
                  </div>


                  <?php $guests1=''; $guests2=''; $guests3=''; $guests4=''; $guests5='';  ?>
                  <?php if (isset($_COOKIE['reservation-values']) && !empty($_COOKIE['reservation-values'])) : ?>
                    <?php if (json_decode($_COOKIE['reservation-values'])[0] == '1') : ?>
                      <?php if (isset(json_decode($_COOKIE['reservation-values'])[4])) : ?>
                        <?php
                          if (json_decode($_COOKIE['reservation-values'])[4] == 1) {
                            $guests1 = 'selected';
                          } elseif (json_decode($_COOKIE['reservation-values'])[4] == 2) {
                            $guests2 = 'selected';
                          } elseif (json_decode($_COOKIE['reservation-values'])[4] == 3) {
                            $guests3 = 'selected';
                          } elseif (json_decode($_COOKIE['reservation-values'])[4] == 4) {
                            $guests4 = 'selected';
                          } elseif (json_decode($_COOKIE['reservation-values'])[4] == 5) {
                            $guests5 = 'selected';
                          }
                        ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>

                  <div class="col-md-6 form-group">
                     <label for="room">Guests</label>
                     <select name="guests" id="guests" class="form-control" required>
                        <option <?= $guests1 ?> value="1">1 Guest</option>
                        <option <?= $guests2 ?> value="2">2 Guests</option>
                        <option <?= $guests3 ?> value="3">3 Guests</option>
                        <option <?= $guests4 ?> value="4">4 Guests</option>
                        <option <?= $guests5 ?> value="5">5+ Guests</option>
                     </select>
                  </div>
               </div>
               
               <div class="row">
                  <div class="col-sm-6 form-group">
                     <label for="">Total: </label>
                     <div style="position: relative;">
                        <input type='text' disabled name="total" class="form-control" id='total' />
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12 form-group">
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email" class="form-control " required>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 form-group">
                     <label for="message">Write a Note</label>
                     <textarea name="note" name="note" id="message" class="form-control " cols="30" rows="8"></textarea>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <input type="submit" name="submit" value="Reserve Now" class="btn btn-primary" onclick="Cookies.remove('reservation-values');">
                  </div>
               </div>
            </form>
         </div>
         
         <div class="col-md-1"></div>

         <div class="col-md-5">
            <h3 class="mb-5">Featured Room</h3>
            <div class="media d-block room mb-0">
               
               <div class="row">
                   <div class="col-12 col-md-10 col-lg-10">
                       <div class="single-rooms-area wow fadeInUp" data-wow-delay="100ms">
                           <!-- Thumbnail -->
                           <div class="bg-thumbnail bg-img" id="featured-room-background-image" style=""></div>
                           <!-- Price -->
                           <p class="price-from" id="featured-room-price"></p>
                           <!-- Rooms Text -->
                           <div class="rooms-text">
                               <div class="line"></div>
                               <h4 id="featured-room-type"></h4>
                               <h4 id="featured-room-beds"></h4>
                               <p id="featured-room-description"></p>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- END section -->
<script>
   $( document ).ready(function() {
       ChangeFeaturedRoom();
   });
</script>