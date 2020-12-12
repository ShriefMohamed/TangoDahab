<div class="col-md-6 col-lg-3">
    <div class="card bg-flat-color-1 text-light">
        <div class="card-body">
            <div class="h4 m-0"><?= CURRENCY ?><?= $allOrdersR[0] ?></div>
            <div><?= $allOrdersR[1] ?> Order</div>
            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <small class="text-light">Total Orders Received</small>
            <hr style="margin-top: 8px; margin-bottom: 8px;">
            <div class="more-info pt-2">
                <a class="font-weight-bold font-xs btn-block text-muted small" style="color: #FFF !important;line-height: 0.5rem;" href="<?= HOST_NAME . 'admin/orders' ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
            </div>
        </div>
    </div>
</div><!--/.col-->

<div class="col-md-6 col-lg-3">
    <div class="card bg-flat-color-2 text-light">
        <div class="card-body">
            <div class="h4 m-0"><?= CURRENCY ?><?= $newOrdersR[0] ?></div>
            <div><?= $newOrdersR[1] ?> Order</div>
            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <small class="text-light">Total New Orders</small>
            <hr style="margin-top: 8px; margin-bottom: 8px;">
            <div class="more-info pt-2">
                <a class="font-weight-bold font-xs btn-block text-muted small" style="color: #FFF !important;line-height: 0.5rem;" href="<?= HOST_NAME . 'admin/neworders' ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
            </div>
        </div>
    </div>
</div><!--/.col-->

<div class="col-md-6 col-lg-3">
    <div class="card bg-flat-color-3 text-light">
        <div class="card-body">
            <div class="h4 m-0"><?= CURRENCY ?><?= $activeOrdersR[0] ?></div>
            <div><?= $activeOrdersR[1] ?> Order</div>
            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <small class="text-light">Total Active Orders</small>
            <hr style="margin-top: 8px; margin-bottom: 8px;">
            <div class="more-info pt-2">
                <a class="font-weight-bold font-xs btn-block text-muted small" style="color: #FFF !important;line-height: 0.5rem;" href="<?= HOST_NAME . 'admin/activeorders' ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
            </div>
        </div>
    </div>
</div><!--/.col-->

<div class="col-md-6 col-lg-3">
    <div class="card bg-flat-color-4 text-light">
        <div class="card-body">
            <div class="h4 m-0"><?= CURRENCY ?><?= $deliveredOrdersR[0] ?></div>
            <div><?= $deliveredOrdersR[1] ?> Order</div>
            <div class="progress-bar bg-light mt-2 mb-2" role="progressbar" style="width: 20%; height: 5px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <small class="text-light">Total Delievered Orders</small>
            <hr style="margin-top: 8px; margin-bottom: 8px;">
            <div class="more-info pt-2">
                <a class="font-weight-bold font-xs btn-block text-muted small" style="color: #FFF !important;line-height: 0.5rem;" href="<?= HOST_NAME . 'admin/doneorders' ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
            </div>
        </div>
    </div>
</div><!--/.col-->

<div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Paid Cash On Delivery</div>
                    <div class="stat-digit"><?= $allOrdersD[1] ?> Delivery</div>
                    <div class="stat-digit"><?= CURRENCY ?><?= $allOrdersD[0] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Profit</div>
                    <div class="stat-digit"><?= CURRENCY ?><?= $allOrdersR[0] + $allOrdersD[0] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
