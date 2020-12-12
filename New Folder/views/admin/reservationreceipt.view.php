<?php $this->RenderTemplate('admin_head'); ?>
<div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12" style="margin: 10px 0 0 0;">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <address style="margin-top: -10px">
                    <img style="width: 30%" src="<?= IMAGES_DIR ?>core-img/logo.png">
                    <br>
                    <?= $contactinfo->email ?>
                    <br>
                    <?= $contactinfo->address ?>
                    <br>
                    <abbr title="Phone"></abbr>+20<?= $contactinfo->phone ?>
                </address>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 text-right" style="position: absolute;right: 0;">
                <p>
                    <?php $date = explode(' ', $reservation->reservation_date); ?>
                    <?php $date = date_create($date[0]); ?>
                    <em>Date: <?= date_format($date, "dS M Y") ?></em>
                </p>
                <p>
                    <em>Receipt #: <?= $reservation->id ?></em>
                </p>
            </div>
        </div>
        <div class="row" style="margin-left: 0px;margin-top: -15px">
            <div class="text-center">
                <h1>Receipt</h1>
            </div>
            <style>
                .table td {padding: 0 5px 0 5px;line-height: 40px;}
            </style>
            <table class="table table-hover" style="margin-top: 5px">
                <tbody>
                    <?php if (isset($reservation) && $reservation != null) : ?>
                        <tr>
                            <td class="col-8"><em>Arrival Date: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->check_in ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Departure Date: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->check_out ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Staying Period: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->period ?> Night<?php if ($reservation->period > 1) echo 's'; ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Room Number: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->room_number ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Room Price: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->room_price ?>EGP/night</strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Email: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->email ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Reservation Status: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= ucfirst($reservation->reservation_status) ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Payment Status: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= ucfirst($reservation->payment_status) ?></strong></p></td>
                        </tr>


                        <tr>
                            <td class="col-8"><em>Staying Period: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->period ?>Night<?php if ($reservation->period > 1) echo 's'; ?></strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Amount Paid: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->amount_paid_egp ?>EGP</strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Amount Due: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->amount_due ?>EGP</strong></p></td>
                        </tr>
                        <tr>
                            <td class="col-8"><em>Date&Time Reservation Was Placed: </em></td>
                            <td>    </td>
                            <td>    </td>
                            <td class="text-left"><p><strong><?= $reservation->reservation_date ?></strong></p></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right"><h4><strong>Total: </strong></h4></td>
                        <td class="text-left text-danger"><h4><strong><?= $reservation->total_amount ?>EGP</strong></h4></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" onclick="window.print();" class="btn btn-success btn-lg btn-block">
                Print   <span class="glyphicon glyphicon-chevron-right"></span>
            </button></td>
        </div>
    </div>
</div>
<?php $this->RenderTemplate('admin_footer'); ?>