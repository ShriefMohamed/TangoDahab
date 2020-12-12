<!-- ##### Rooms Area Start ##### -->
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

            <?php if (isset($rooms) && $rooms != false) : ?>
            <div class="row">
                <?php foreach ($rooms as $room) : ?>
                <!-- Single Rooms Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-rooms-area wow fadeInUp" data-wow-delay="100ms">
                        <!-- Thumbnail -->
                        <div class="bg-thumbnail bg-img" style="background-image: url(<?= IMAGES_DIR . 'rooms-img/' . $room->image ?>);"></div>
                        <!-- Price -->
                        <p class="price-from">From <?= $room->price ?>EGP/night</p>
                        <!-- Rooms Text -->
                        <div class="rooms-text">
                            <div class="line"></div>
                            <h4><?= ucfirst($room->room_type) ?></h4>
                            <h4><?= $room->beds ?> Beds</h4>
                            <p><?= substr($room->description, 0, 100); ?>...</p>
                        </div>
                        <!-- Book Room -->
                        <input type="hidden" name="room_id" id="room_id" value="<?= $room->room_id ?>">
                        <a href="#" onclick="Reservation(0)" class="book-room-btn btn palatin-btn">Book Room</a>
                    </div>
                </div>

                <?php endforeach; ?>


                <div class="col-12">
                    <!-- Pagination -->
                  <?php $page = ($this->_params) != null ? $this->_params['0'] : 1; ?>
                  <div class="pagination-area wow fadeInUp" data-wow-delay="400ms" style="width: 98%;display: inline-flex;">
                      <div class="col-sm-12 col-md-5">
                          <div class="dataTables_info" id="bootstrap-data-table_info" role="status" aria-live="polite">Showing <?= ((($page * 10) - 10) == 0) ? 1 : ($page * 10) - 10 ?> to <?= (($page * 10) > $total_records) ? $total_records : ($page * 10) ?> of <?= $total_records ?> entries</div>
                      </div>

                      <div class="col-sm-12 col-md-7">
                          <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate">
                              <ul class="pagination">
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                  <li class="paginate_button page-item active"><a href="<?= HOST_NAME . 'index/rooms/' . $i ?>" aria-controls="bootstrap-data-table" data-dt-idx="1" class="page-link"><?= $i ?></a></li>
                                <?php endfor; ?>

                                  <li class="paginate_button page-item next" id="bootstrap-data-table_next"><a href="<?= HOST_NAME . 'index/rooms/' . ($page + 1) ?>" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        
            <?php endif; ?>

        </div>
    </section>
    <!-- ##### Rooms Area End ##### -->