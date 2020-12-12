<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-12 col-md-9" style="margin-bottom: 25px">
                <select name="select" id="filter-reservations" class="form-control" onchange="FilterReservtions()">
                    <?php
                    $all_reservations = ''; $unconfirmed_reservations = ''; $confirmed_reservations = '';
                    $upcoming_reservations = ''; $active_reservations = ''; $done_reservations = '';

                    if (isset($_GET['filter'])) :
                        $filter = $_GET['filter'];

                        $all_reservations = ($filter == 'reservations') ? 'selected' : null;
                        $unconfirmed_reservations = ($filter == 'unconfirmedreservations') ? 'selected' : null;
                        $confirmed_reservations = ($filter == 'confirmedreservations') ? 'selected' : null;
                        $upcoming_reservations = ($filter == 'upcomingreservations') ? 'selected' : null;
                        $active_reservations = ($filter == 'activereservations') ? 'selected' : null;
                        $done_reservations = ($filter == 'donereservations') ? 'selected' : null;
                        endif;
                    ?>
                    <option <?= $all_reservations ?> value="reservations">All Reservations</option>
                    <option <?= $unconfirmed_reservations ?> value="unconfirmedreservations">Unconfirmed Reservations</option>
                    <option <?= $confirmed_reservations ?> value="confirmedreservations">Confirmed Reservations</option>
                    <option <?= $upcoming_reservations ?> value="upcomingreservations">Upcoming Reservations</option>
                    <option <?= $active_reservations ?> value="activereservations">Active Reservations</option>
                    <option <?= $done_reservations ?> value="donereservations">Old Reservations</option>
                </select>
            </div>

            <script>
                function FilterReservtions() {
                    let filter = document.getElementById('filter-reservations').options[document.getElementById('filter-reservations').selectedIndex].value;
                    let location = document.location.origin + document.location.pathname;

                    if (filter) {
                        console.log(location + '?filter=' + filter);
                        window.open(location + '?filter=' + filter,'_self');
                    }
                }
            </script>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Reservations</strong>
                    </div>

                    <div class="card-body">
                        <div class="accordion" id="accordionExample">

                        <?php if (isset($invoices) && $invoices != false) : ?>
                            <?php foreach ($invoices as $invoice) : ?>
                            <div class="card">
                                <div class="card-header font-weight-bold" id="headingOne<?= $invoice->reservation_id ?>">
                                    <a href="#" data-toggle="collapse" data-target="#collapseOne<?= $invoice->reservation_id ?>" aria-expanded="false" aria-controls="collapseOne<?= $invoice->reservation_id ?>" class="collapsed">
                                        <div class="row">
                                            <div class="col" id="title-header-col">
                                                Reservation #<?= $invoice->reservation_id ?>, Room #<?= $invoice->room_number ?>

                                                <?php if ($_SESSION['privileges']->add_reservations == '1') : ?>
                                                <a href="<?= HOST_NAME . 'admin/deletereservation/' . $invoice->reservation_id ?>" class="btn btn-primary btn-sm">Delete</a>
                                                <?php endif; ?>

                                                <?php if ($_SESSION['privileges']->update_reservations == '1') : ?>
                                                <a href="<?= HOST_NAME . 'admin/editinvoice/' . $invoice->reservation_id ?>" class="btn btn-primary btn-sm">Update Invoice</a>
                                                <a href="<?= HOST_NAME . 'admin/editreservation/' . $invoice->reservation_id ?>" class="btn btn-primary btn-sm">Update Reservation</a>
                                                <?php endif; ?>

                                                <a href="<?= HOST_NAME . 'admin/reservationreceipt/' . $invoice->reservation_id ?>" class="btn btn-primary btn-sm">Receipt</a>
                                            </div>
                                            <div class="col-auto collapse-icon"></div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne<?= $invoice->reservation_id ?>" class="collapse" aria-labelledby="headingOne<?= $invoice->reservation_id ?>" data-parent="#collapseOne<?= $invoice->reservation_id ?>" style="">
                                    <div class="card-body">

                                        <div class="card">
                                            <div class="card-header font-weight-bold" id="headingReservation">
                                                <a href="#" data-toggle="collapse" data-target="#collapseReservation<?= $invoice->reservation_id ?>" aria-expanded="false" aria-controls="collapseReservation<?= $invoice->reservation_id ?>" class="collapsed">
                                                    <div class="row">
                                                        <div class="col">
                                                            Reservation Details
                                                        </div>
                                                        <div class="col-auto collapse-icon"></div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseReservation<?= $invoice->reservation_id ?>" class="collapse" aria-labelledby="headingReservation" data-parent="#collapseReservation<?= $invoice->reservation_id ?>" style="">
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Reservation #: </span><?= $invoice->reservation_id ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Arrival Date: </span><?= $invoice->check_in ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Departure Date: </span><?= $invoice->check_out ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Staying Period: </span><?= $invoice->period ?> Night<?php if ($invoice->period > 1) echo 's'; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Room Number: </span><?= $invoice->room_number ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Room Price: </span><?= $invoice->room_price ?>EGP/night
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Email: </span><?= $invoice->email ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Note: </span><?= $invoice->note ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Reservation Status: </span><?= ucfirst($invoice->reservation_status) ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Payment Status: </span><?= ucfirst($invoice->payment_status) ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header font-weight-bold" id="headingOrder">
                                                <a href="#" data-toggle="collapse" data-target="#collapseOrder<?= $invoice->reservation_id ?>" aria-expanded="false" aria-controls="collapseOrder<?= $invoice->reservation_id ?>" class="collapsed">
                                                    <div class="row">
                                                        <div class="col">
                                                            Invoice Details
                                                        </div>
                                                        <div class="col-auto collapse-icon"></div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseOrder<?= $invoice->reservation_id ?>" class="collapse" aria-labelledby="headingOrder" data-parent="#collapseOrder<?= $invoice->reservation_id ?>" style="">
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Room Price: </span><?= $invoice->room_price ?>EGP/night
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Staying Period: </span><?= $invoice->period ?> Night<?php if ($invoice->period > 1) echo 's'; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Total Amount: </span><?= $invoice->total_amount ?>EGP
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Amount Paid USD: </span><?= $invoice->amount_paid ?>USD
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Amount Paid EGP: </span><?= $invoice->amount_paid_egp ?>EGP
                                                        </li>
                                                        <li class="list-group-item">
                                                                <span class="font-weight-bold">Amount Due: </span><?= $invoice->amount_due ?>EGP
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Date&Time Reservation Was Placed: </span><?= $invoice->reservation_date ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Date&Time Invoice Was Last Updated: </span><?= $invoice->last_updated ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header font-weight-bold" id="headingCustomer">
                                                <a href="#" data-toggle="collapse" data-target="#collapseCustomer<?= $invoice->reservation_id ?>" aria-expanded="false" aria-controls="collapseCustomer<?= $invoice->reservation_id ?>" class="collapsed">
                                                    <div class="row">
                                                        <div class="col">
                                                            Customer Details
                                                        </div>
                                                        <div class="col-auto collapse-icon"></div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div id="collapseCustomer<?= $invoice->reservation_id ?>" class="collapse" aria-labelledby="headingCustomer" data-parent="#collapseCustomer<?= $invoice->reservation_id ?>" style="">
                                                <div class="card-body">
                                                    <?php if ($invoice->user_id != null) : ?>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's ID: </span><?= $invoice->user_id ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's Name: </span><?= $invoice->fullname ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's Username: </span><?= $invoice->username ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's Email: </span><?= $invoice->user_email ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's Phone: </span><?= $invoice->phone ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="font-weight-bold">Customer's Governorate: </span><?= $invoice->governorate ?>
                                                        </li>
                                                    </ul>
                                                    <?php else : ?>
                                                    <span>Reservation was created by non registered user</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-8">
                                <div class="row">
                                    <h4>No reservations found!</h4>
                                </div>
                            </div>
                        <?php endif; ?>

                        </div>
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
                                <li class="paginate_button page-item active">
                                    <script>
                                        if (document.location.search !== "") {
                                            document.write("<a href='"+ document.location.origin +"/admin/reservations/<?= $i ?>"+ document.location.search +"' aria-controls='bootstrap-data-table' data-dt-idx='1' class='page-link'><?= $i ?></a>");
                                        } else {
                                            document.write("<a href='"+ document.location.origin +"/admin/reservations/<?= $i ?>' aria-controls='bootstrap-data-table' data-dt-idx='1' class='page-link'><?= $i ?></a>");
                                        }
                                    </script>
                                </li>
                            <?php endfor; ?>

                            <li class="paginate_button page-item next" id="bootstrap-data-table_next">
                                <script>
                                    document.write("<a href='"+ document.location.origin +"/admin/reservations/<?= ($page + 1) ?>"+ document.location.search +"' aria-controls='bootstrap-data-table' data-dt-idx='4' tabindex='0' class='page-link'>Next</a>");
                                </script>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<style>
    #title-header-col .btn {float: right;margin: 0 1%;}
</style>
