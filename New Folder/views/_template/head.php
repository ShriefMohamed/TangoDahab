<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Tango - Camp &amp; Resort</title>

    <!-- Favicon -->
    <link rel="icon" href="<?= IMAGES_DIR ?>core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?= HOST_NAME ?>style.css">
    <link rel="stylesheet" href="<?= JS_DIR ?>jquery-ui/jquery-ui.min.css"">
    
    <!-- jQuery-2.2.4 js -->
    <script src="<?= JS_DIR ?>jquery/jquery-2.2.4.min.js"></script>
    <script src="<?= JS_DIR ?>js.cookie.js"></script>
    <script>
        function SendMessage(message_id) {
            jQuery("#chat-form").submit(function (e) {
                var form_data = jQuery(this).serialize();
                var button = jQuery(this).find('button[type=submit]');
                button.html('Sending...');
                url = "<?= HOST_NAME ?>user/sendmessage/" + message_id;
                jQuery.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: form_data
                }).done(function (data) {
                    if (data) {
                        if (data.status !== 1) {
                            alert(data.response);
                            button.html('Send');
                        } else {
                            var li = "<li class=\"right clearfix\">" +
                                "    <span class=\"chat-img pull-right\">" +
                                "    <img src=\"<?= IMAGES_DIR ?>users-img/customer.png\" alt=\"User Avatar\" style=\"height:44px;width:50px\" class=\"img-circle\" />" +
                                "    </span>" +
                                "    <div class=\"chat-body clearfix\">" +
                                "       <div class=\"header\">\n" +
                                "       <small class=\" text-muted\"><i class=\"fa fa-clock-o\"></i>Just now</small>" +
                                "       <strong class=\"pull-right primary-font\"><?= $_SESSION['loggedin']->fullname ?></strong>" +
                                "       </div>" +
                                "     <p>"+data.response+"</p>" +
                                "    </div>" +
                                "</li>";
                            jQuery("#chat-ul").append(li);
                            jQuery(".form-control")[0].value = '';
                            button.html('Send');
                        }
                    }
                });
                e.preventDefault();
            });
        }
    </script>
</head>
<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">

	<!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="cssload-container">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>

