<section class="section-padding-100">
    <div class="container">

        <div class="col-12">
            <div class="elements-title">
                <h2>Reservation &amp; Invoice</h2>
            </div>
        </div>

        <?php if (isset($invoice) && $invoice != false) : ?>
            <!-- ##### Accordians ##### -->
            <div class="col-12 col-lg-6 mb-50">
                <div class="accordions" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- single accordian area -->
                    <div class="panel single-accordion">
                        <h6><a role="button" class="" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Reservation Details
                                <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </a></h6>
                        <div id="collapseOne" class="accordion-content collapse show">
                            <div class="row row-value-reservation-payment">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <h6>Reservation # :</h6>
                                    <hr>
                                    <h6>Arrival Date :</h6>
                                    <hr>
                                    <h6>Departure Date :</h6>
                                    <hr>
                                    <h6>Staying Period :</h6>
                                    <hr>
                                    <h6>Room # :</h6>
                                    <hr>
                                    <h6>Room Price :</h6>
                                    <hr>
                                    <h6>Email :</h6>
                                    <hr>
                                    <h6>Reservation Status : </h6>
                                    <hr>
                                    <h6>Payment Status : </h6>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <p><?= $invoice->reservation_id ?></p>
                                    <hr>
                                    <p><?= $invoice->check_in ?></p>
                                    <hr>
                                    <p><?= $invoice->check_out ?></p>
                                    <hr>
                                    <p><?= $invoice->period ?> Night<?php if ($invoice->period > 1) echo 's'; ?></p>
                                    <hr>
                                    <p><?= $invoice->room_number ?></p>
                                    <hr>
                                    <p><?= $invoice->room_price ?>EGP/night</p>
                                    <hr>
                                    <p><?= $invoice->email ?></p>
                                    <hr>
                                    <p><?= ucfirst($invoice->reservation_status) ?></p>
                                    <hr>
                                    <p><?= ucfirst($invoice->payment_status) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single accordian area -->
                    <div class="panel single-accordion">
                        <h6>
                            <a role="button" class="collapsed" aria-expanded="true" aria-controls="collapseTwo" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">Invoice Details
                                <span class="accor-open"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="accor-close"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            </a>
                        </h6>
                        <div id="collapseTwo" class="accordion-content collapse">
                            <div class="row row-value-reservation-payment">
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <h6>Room Price :</h6>
                                    <hr>
                                    <h6>Staying Period :</h6>
                                    <hr>
                                    <h6>Total Amount : </h6>
                                    <hr>
                                    <h6>Amount Paid USD : </h6>
                                    <hr>
                                    <h6>Amount Paid EGP : </h6>
                                    <hr>

                                    <h6>Amount Due : </h6>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6">
                                    <p><?= $invoice->room_price ?>EGP/night</p>
                                    <hr>
                                    <p><?= $invoice->period ?> Night<?php if ($invoice->period > 1) echo 's'; ?></p>
                                    <hr>
                                    <p><?= $invoice->total_amount ?>EGP</p>
                                    <hr>
                                    <p><?= $invoice->amount_paid ?>USD</p>
                                    <hr>
                                    <p><?= $invoice->amount_paid_egp ?>EGP</p>
                                    <hr>
                                    <p><?= $invoice->amount_due ?>EGP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .row-value-reservation-payment div {padding-right: 0 !important; padding-left: 0 !important}
    .row-value-reservation-payment h6 {line-height: 1.86;margin-bottom: 10px}
    .row-value-reservation-payment p {margin-bottom: 10px !important}

</style>