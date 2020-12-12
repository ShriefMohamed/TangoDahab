<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Reserved Rooms</strong>
                  </div>
                  <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead style="font-size: 14px">
                      <tr>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Beds</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Room Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($rooms) && $rooms != null) : ?>
                        <?php foreach ($rooms as $room) : ?>
                          <tr>

                            <td><?= $room->room_number ?></td>
                            <td><?= $room->room_type ?></td>
                            <td><?= $room->beds ?></td>
                            <td><?= $room->price ?></td>
                            <td><?= substr($room->description, 0, 80) ?></td>
                            <td><img src="<?= IMAGES_DIR . 'rooms-img/' . $room->image ?>"></td>
                            <td><?= ucfirst($room->status) ?></td>

                            <td><a href="<?= HOST_NAME . 'admin/editroom/' . $room->room_id ?>">Edit</a></td>
                            <td><a href="<?= HOST_NAME . 'admin/deleteroom/' . $room->room_id ?>" onclick="return getConfirmation('Are you sure you want to delete this user?');">Delete</a></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                  </div>
              </div>
          </div>

          <?php $page = ($this->_params) != null ? $this->_params['0'] : 1; ?>
          <div class="row" style="width: 98%;position: relative;left: 2%;">
              <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="bootstrap-data-table_info" role="status" aria-live="polite">Showing <?= ((($page * 10) - 10) == 0) ? 1 : ($page * 10) - 10 ?> to <?= (($page * 10) > $total_records) ? $total_records : ($page * 10) ?> of <?= $total_records ?> entries</div>
              </div>

              <div class="col-sm-12 col-md-7" style="right: 0;position: absolute;float: right;width: 27.5%;">
                  <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate">
                      <ul class="pagination">
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                          <li class="paginate_button page-item active"><a href="<?= HOST_NAME . 'admin/reservedrooms/' . $i ?>" aria-controls="bootstrap-data-table" data-dt-idx="1" class="page-link"><?= $i ?></a></li>
                        <?php endfor; ?>

                          <li class="paginate_button page-item next" id="bootstrap-data-table_next"><a href="<?= HOST_NAME . 'admin/reservedrooms/' . ($page + 1) ?>" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

