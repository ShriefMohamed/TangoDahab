<?php if (isset($reservation) && $reservation !== false) : ?>
    <div class="card">
        <div class="card-header">
            Update Invoice<strong> #<?= $reservation->invoice_id ?></strong>
        </div>
        <div class="card-body card-block">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="total" class=" form-control-label">Total Amount</label></div>
                    <div class="col-12 col-md-9">
                        <input type="number" onchange="CalcAmountDue('t')" id="total" name="total" placeholder="<?= $reservation->total ?>EGP" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="hidden_total" value="<?= $reservation->total ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="total" class=" form-control-label">Amount Paid In USD</label></div>
                    <div class="col-12 col-md-9">
                        <input type="number" id="amount_paid" name="amount_paid" placeholder="<?= $reservation->amount_paid ?>USD" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="hidden_amount_paid" value="<?= $reservation->amount_paid ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="total" class=" form-control-label">Amount Paid In EGP</label></div>
                    <div class="col-12 col-md-9">
                        <input type="number" onchange="CalcAmountDue('p')" id="amount_paid_egp" name="amount_paid_egp" placeholder="<?= $reservation->amount_paid_egp ?>EGP" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="hidden_amount_paid_egp" value="<?= $reservation->amount_paid_egp ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="total" class=" form-control-label">Amount Due</label></div>
                    <div class="col-12 col-md-9">
                        <input type="number" onchange="CalcAmountDue('d')" id="amount_due" name="amount_due" placeholder="<?= $reservation->amount_due ?>EGP" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="hidden_amount_due" value="<?= $reservation->amount_due ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="total" class=" form-control-label">Payment Method</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="payment_method" name="payment_method" placeholder="<?= $reservation->payment_method ?>" class="form-control">
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
<?php endif; ?>

<script>
    function CalcAmountDue(state) {
        var total = document.getElementById('total'),
            amount_paid_egp = document.getElementById('amount_paid_egp'),
            amount_due = document.getElementById('amount_due'),
            hidden_total = document.getElementById('hidden_total'),
            hidden_amount_paid_egp = document.getElementById('hidden_amount_paid_egp'),
            hidden_amount_due = document.getElementById('hidden_amount_due');


        if (state == 't') {
            if (total.value) {
                var due_val = 0;
                var due = (parseInt(total.value) - parseInt(hidden_total.value)) + parseInt(hidden_amount_due.value);
                var paid = parseInt(due) - (parseInt(total.value) - parseInt(hidden_total.value));
                if (due == 0) {amount_due.value = 0.00;} else {amount_due.value = due;}
                if (paid == 0) {amount_paid_egp.value = 0.00;} else {amount_paid_egp.value = paid;}

            }
        } else if (state == 'p') {
            var t = 0;
            if (total.value) {t = total.value;} else {t = hidden_total.value;}
            var paid = (parseInt(t) - parseInt(amount_paid_egp.value));

            if (paid == 0) {
                amount_due.value = 0.00;
            } else {
                amount_due.value = paid;
            }
        } else if (state == 'd') {
            var t = 0;
            if (total.value) {t = total.value;} else {t = hidden_total.value;}
            var paid = (parseInt(t) - parseInt(amount_due.value));

            if (paid == 0) {
                amount_paid_egp.value = 0.00;
            } else {
                amount_paid_egp.value = paid;
            }
        }

    }
</script>