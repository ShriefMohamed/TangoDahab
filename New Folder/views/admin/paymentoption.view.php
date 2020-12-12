<?php if (isset($option) && $option != null) : ?>
    <?php if ($option->content != 1) : ?>
        <?php $checked = ''; ?>
    <?php else : ?>
        <?php $checked = 'checked'; ?>
    <?php endif; ?>

<div class="card">
    <div class="card-header">
        <strong class="card-title">Manage Not Paying Option</strong>
    </div>

    <div class="card-body">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">The ability to not pay online</h4>
            <p>Whenever a user makes a reservation, he can pay the whole amount or half of the amount;
            <br> This option controls if the user is able also, to not pay online at all, and pay cash when he arrive.</p>
            <hr>
            
            <div class="row ml-1">
                <strong class="mr-3">OFF</strong>

                <form method="post" id="payment-option-form">
                    <input type="hidden" name="value">

                    <label class="switch switch-lg switch-3d switch-success mr-3">
                        <input type="checkbox" name="option" class="switch-input" <?= $checked ?> onchange="document.getElementById('payment-option-form').submit();"> 
                        <span class="switch-label"></span> 
                        <span class="switch-handle"></span>
                    </label>

                </form>

                <strong>ON</strong>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>