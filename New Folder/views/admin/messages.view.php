<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Messages From Customers</strong>
                  </div>

                  <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered" style="font-size: 14px">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th width="15%">Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Respond</th>
                        <td>Delete</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($messages) && $messages != null) : ?>
                        <?php foreach ($messages as $message) : ?>
                          <tr>
                            <td><a href="<?= HOST_NAME . 'admin/message/' . $message->message_id ?>"><?= $message->message_id ?></a></td>
                            <td><?= $message->name ?></td>
                            <td><?= $message->email ?></td>
                            <td><?= $message->subject ?></td>
                            <td><?= substr($message->message, 0, 40) ?>...</td>
                            <td><?= date('F d, Y', strtotime($message->date)) ?></td>
                            <?php $status = ($message->status == 0) ? 'No Admin Responded' : 'Admin Responded'; ?>
                            <td><?= $status ?></td>
                            <td><a href="<?= HOST_NAME . 'admin/message/' . $message->message_id ?>">Respond</a></td>
                            <td><a href="<?= HOST_NAME . 'admin/deletemessage/' . $message->message_id ?>" onclick="getConfirmation('Are you sure you want to delete this message?');">Delete</a></td>
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
                          <li class="paginate_button page-item active"><a href="<?= HOST_NAME . 'admin/messages/' . $i ?>" aria-controls="bootstrap-data-table" data-dt-idx="1" class="page-link"><?= $i ?></a></li>
                        <?php endfor; ?>

                          <li class="paginate_button page-item next" id="bootstrap-data-table_next"><a href="<?= HOST_NAME . 'admin/messages/' . ($page + 1) ?>" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

