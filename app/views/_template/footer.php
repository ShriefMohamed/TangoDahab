    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-lg-5">
                    <div class="footer-widget-area mt-50">
                        <a href="<?= HOST_NAME ?>" class="d-block mb-5" style="width: 60%"><img src="<?= IMAGES_DIR ?>core-img/logo.png" alt=""></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. </p>
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="footer-widget-area mt-50">
                        <h6 class="widget-title mb-5">Find us on the map</h6>
                        <img src="<?= IMAGES_DIR ?>bg-img/footer-map.png" alt="">
                    </div>
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-widget-area mt-50 mb-50">
                        <h6 class="widget-title mb-5">Subscribe to our newsletter</h6>
                        <form action="#" method="post" id="subscribe-form" class="subscribe-form">
                            <input type="email" name="subscribe-email" id="subscribe-email" placeholder="Your E-mail">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                    <a class="text-light text-capitalize" href="<?= HOST_NAME ?>index/termsconditions">Terms & Conditions</a>
                </div>

                <!-- Copywrite Text -->
                <div class="col-12">
                    <div class="copywrite-text mt-30">
                        <p><a href="#">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Designed & Developed with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">Shrief Mohamed</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-ui -->
    <script src="<?= JS_DIR ?>jquery-ui/jquery-ui.min.js"></script>
    <!-- Popper js -->
    <script src="<?= JS_DIR ?>bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?= JS_DIR ?>bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="<?= JS_DIR ?>plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="<?= JS_DIR ?>active.js"></script>

    <script>
        $( document ).ready(function() {
            $('.reservation_date').datepicker({ minDate: 0, dateFormat: "dd/mm/yy" });
            $('#subscribe-form').bind("submit", Subscribe());
        });

        function Reservation(state) {
            if (state == '1') {
                var checkIn = document.getElementById('select1').options[document.getElementById('select1').selectedIndex].value,
                    checkOut = document.getElementById('select2').options[document.getElementById('select2').selectedIndex].value,
                    guests = document.getElementById('select3').options[document.getElementById('select3').selectedIndex].value,
                    room = document.getElementById('select4').options[document.getElementById('select4').selectedIndex].value;

                var values = ['1', room, checkIn, checkOut, guests];
                Cookies.set('reservation-values', JSON.stringify(values));
            } else {
                var roomId = document.getElementById('room_id').value;

                var values = ['0', roomId];
                Cookies.set('reservation-values', JSON.stringify(values));
            }

            window.open('<?= HOST_NAME ?>reservation/reservation/','_self');
        }

        function ChangeFeaturedRoom() {
            var id = document.getElementById('room').options[document.getElementById('room').selectedIndex].value;

            var backgroundDiv = document.getElementById('featured-room-background-image'),
                roomPrice = document.getElementById('featured-room-price'),
                roomType = document.getElementById('featured-room-type'),
                roomBeds = document.getElementById('featured-room-beds'),
                roomDescription = document.getElementById('featured-room-description');

            $.ajax({
                url: "<?= HOST_NAME ?>index/getfroom/" + id,
                type: "POST",
                dataType: "json",
            }).done(function(data) {
                if (data) {
                    backgroundDiv.style.backgroundImage = 'url(<?= IMAGES_DIR ?>rooms-img/' +data.backgroundDiv + ')';
                    roomPrice.innerText = "From " + data.roomPrice + "EGP/night";
                    roomType.innerText = data.roomType;
                    roomBeds.innerText = data.roomBeds + " Beds";
                    roomDescription.innerText = data.roomDescription + "...";
                }
            });
        };

        function CalcTotal() {
            var room = encodeURIComponent(document.getElementById('room').options[document.getElementById('room').selectedIndex].value),
                arrival_date = encodeURIComponent(document.getElementById('arrival_date').value),
                departure_date = encodeURIComponent(document.getElementById('departure_date').value),
                total = document.getElementById('total');

            if (room) {
                var parameters = "room_id="+room+'&check_in='+arrival_date+'&check_out='+departure_date;

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            var result = JSON.parse(this.responseText);
                            if (result.status != 1) {
                                if (result.msg) {
                                    alert(result.msg);
                                }
                            } else {
                                if (result.total && Number.isInteger(result.total)) {
                                    total.value = result.total + ' EGP';
                                }
                            }
                        }
                    }
                };

                xmlhttp.open("POST", "<?= HOST_NAME ?>index/calctotal/" ,true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(parameters);
            }
        }

        function Subscribe() {
            $("#subscribe-form").submit(function (e) {
                var form_data = $(this).serialize();
                var button = $(this).find('button[type=submit]');
                button.html('Subscribing...');
                url = "<?= HOST_NAME ?>index/subscribe/";
                jQuery.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: form_data
                }).done(function (data) {
                    if (data) {
                        if (data.status == 1) {
                            alert("You have subscribed successfully.");
                            button.html('Subscribed');
                        } else if (data.status == 2) {
                            alert("You're already subscribed.");
                            button.html('Subscribed');
                        } else {
                            alert("Failed to create subscribtion. try again later or contact the support.");
                            button.html('Subscribe');
                        }
                    }
                });
                e.preventDefault();
            });
        }
    </script>
</body>

</html>