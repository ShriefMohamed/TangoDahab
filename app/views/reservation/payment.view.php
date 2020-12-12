<section class="section-padding-100">
   <div class="container">

        <div class="col-12">
            <div class="elements-title">
                <h2>Reservation &amp; Payment</h2>
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

        <?php if (!isset($option) || $option == false) : ?>
            <?php $option = '0'; ?>
        <?php endif; ?>
        
        <!-- ##### Tabs ##### -->
        <div class="col-12 col-lg-6">

            <?php if ($option->content != '1') : ?>
            <div class="rom col-12 mt-50 mb-50" style="padding-left: 0">
                <span>In order to maintain the stability of transactions, your reservation won't be confirmed until you pay at least half of the total amount.</span>
            </div>
            <?php endif; ?>
            
            <?php if ($option->content == '1') : ?>
            <div class="palatin-tabs-content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab--3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="true">Checkout Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false">Pay Cash When You Arrive</a>
                    </li>
                </ul>

                <div class="tab-content mb-100" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab3" role="tabpanel" aria-labelledby="tab--3">
                        <div class="palatin-tab-content">

            <?php endif; ?>

                            <div class="contact-form-area">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12" style="padding-left: 0">

                                            <div><h3 class="text-center">Pay Invoice</h3></div>
                                            <hr>

                                            <form method="post" action="<?= HOST_NAME . 'reservation/paynow/' . $invoice->reservation_id ?>">

                                                <div class="form-group text-center">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item"><i class="text-muted fa fa-cc-paypal fa-2x"></i></li>
                                                        <li class="list-inline-item"><i class="fa fa-cc-visa fa-2x"></i></li>
                                                        <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                                                        <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                                                        <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
                                                    </ul>
                                                </div>


                                                <div class="row">
                                                    <div class="col-9">
                                                        <input type="text" id="paying-form-total" class="form-control" value="<?= $invoice->total_amount ?>EGP" disabled="" style="border-color: #cb8670;background: none !important;font-size: 16px">
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="paying-option">
                                                            <input type="radio" onclick="document.getElementById('paying-form-total').value = '<?= $invoice->total ?>' + 'EGP';" name="paying-option" checked value="1" style="width: 20px;height: 14px;">  Pay All Amount
                                                        </label>
                                                        <label for="paying-option" class="ml-50">
                                                            <input type="radio" onclick="document.getElementById('paying-form-total').value = (parseInt('<?= $invoice->total ?>') / 2) + 'EGP';" name="paying-option" value="0" style="width: 20px;height: 14px;">  Pay Half Amount
                                                        </label>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" name="submit" class="btn palatin-btn btn-2 mt-50">Continue</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

            <?php if ($option->content == '1') : ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                        <div class="palatin-tab-content">
                            <!-- Tab Text -->
                            <div class="palatin-tab-text">

                                <div class="row">
                                    <div class="col-9 mb-50">
                                        <p>Confirm now and pay in person when you arrive.</p>
                                    </div>
                                    <div class="col-12">
                                        <a href="<?= HOST_NAME . 'reservation/paylater/' . $invoice->reservation_id ?>" class="btn palatin-btn btn-2 m-2">Continue</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php endif; ?>

        </div>
        
        <?php endif; ?>
    </div>
</section>

<style>
    .row-value-reservation-payment div {padding-right: 0 !important; padding-left: 0 !important}
    .row-value-reservation-payment h6 {line-height: 1.86;margin-bottom: 10px}
    .row-value-reservation-payment p {margin-bottom: 10px !important}

</style>