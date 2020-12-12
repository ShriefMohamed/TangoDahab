<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Customers</strong>
                  </div>
                  <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th width="15%">Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Governorate</th>
                        <th>Member Since</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($users) && $users != null) : ?>
                        <?php foreach ($users as $user) : ?>
                          <tr>
                            <td><?= $user->user_id ?></td>
                            <td><?= $user->fullname ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->phone ?></td>
                            <td><?= $user->governorate ?></td>
                            
                            <?php $date = explode(' ', $user->created); ?>
                            <td><?= $date[0] ?></td>

                            <td><a href="<?= HOST_NAME . 'admin/edituser/' . $user->user_id ?>">Edit</a></td>
                            <td><a href="<?= HOST_NAME . 'admin/deleteuser/' . $user->user_id ?>" onclick="getConfirmation('Are you sure you want to delete this user?');">Delete</a></td>
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
                          <li class="paginate_button page-item active"><a href="<?= HOST_NAME . 'admin/managecustomers/' . $i ?>" aria-controls="bootstrap-data-table" data-dt-idx="1" class="page-link"><?= $i ?></a></li>
                        <?php endfor; ?>

                          <li class="paginate_button page-item next" id="bootstrap-data-table_next"><a href="<?= HOST_NAME . 'admin/managecustomers/' . ($page + 1) ?>" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

