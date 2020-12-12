        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?= ASSETS_DIR ?>js/plugins.js"></script>
    <script src="<?= ASSETS_DIR ?>js/main.js"></script>

    <script src="<?= ASSETS_DIR ?>js/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?= ASSETS_DIR ?>js/dashboard.js"></script>
    <script src="<?= ASSETS_DIR ?>js/widgets.js"></script>


    <script>
            function CalcTotal(reservation_id) {
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

                    xmlhttp.open("POST", "<?= HOST_NAME ?>admin/calctotal/"+reservation_id ,true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send(parameters);
                }
            }
    </script>

</body>
</html>
