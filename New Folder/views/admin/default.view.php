<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $rooms ?></span>
            </h4>
            <p class="text-light">All Rooms</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $active_rooms ?></span>
            </h4>
            <p class="text-light">Active Rooms</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $inactive_rooms ?></span>
            </h4>
            <p class="text-light">Inactive Rooms</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $empty_rooms ?></span>
            </h4>
            <p class="text-light">Empty Rooms</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-5">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $reserved_rooms ?></span>
            </h4>
            <p class="text-light">Reserved Rooms</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>

<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $reservations ?></span>
            </h4>
            <p class="text-light">All Reservations</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $active_reservations ?></span>
            </h4>
            <p class="text-light">Active Reservation</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $finished_reservations ?></span>
            </h4>
            <p class="text-light">Finished Reservations</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $news ?></span>
            </h4>
            <p class="text-light">Posts</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $testimonials ?></span>
            </h4>
            <p class="text-light">Testimonials</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $subscriptions ?></span>
            </h4>
            <p class="text-light">Subscriptions</p>
        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-5">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $customers ?></span>
            </h4>
            <p class="text-light">Customers</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $admins ?></span>
            </h4>
            <p class="text-light">Administrators</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $recevivedMessages ?></span>
            </h4>
            <p style="font-size: 15px" class="text-light">Recevived Messages</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <h4 class="mb-0">
                <span class="count"><?= $sentMessages ?></span>
            </h4>
            <p class="text-light">Sent Messages</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <canvas id="widgetChart4"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->
