<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tango - Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= IMAGES_DIR ?>core-img/favicon.ico" />
    
    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/normalize.css">
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/themify-icons.css">
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="<?= ASSETS_DIR ?>/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="<?= ASSETS_DIR ?>/scss/style.css">
    <!-- JAVASCRIPT -->
    <script src="<?= JS_DIR ?>main.js"></script>
    <script src="<?= ASSETS_DIR ?>js/vendor/jquery-2.1.4.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <script>
        function replaceImageWithInput() {
            var input = "<input type='file' name='image'/>";

            jQuery("#testimonial-image-element").remove(); 
            jQuery("#image-input-form-group").append(input);
        } 
        
        function SendMessage(message_id) {
            jQuery("#chat-form").submit(function (e) {
                var form_data = jQuery(this).serialize();
                var button = jQuery(this).find('button[type=submit]');
                button.html('Sending...');
                url = "<?= HOST_NAME ?>admin/sendmessage/" + message_id;
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
                            var li = "<li class=\"left clearfix\">" +
                                    "    <span class=\"chat-img pull-left\">" +
                                    "    <img src=\"<?= IMAGES_DIR ?>users-img/admin.png\" alt=\"User Avatar\" style=\"height:44px;width:50px\" class=\"img-circle\" />" +
                                    "    </span>" +
                                    "    <div class=\"chat-body clearfix\">" +
                                    "       <div class=\"header\">\n" +
                                    "       <strong class=\"primary-font\"><?= $_SESSION['loggedin']->fullname ?></strong> <small class=\"pull-right text-muted\">" +
                                    "       <i class=\"fa fa-clock-o\"></i></span>Just now</small>" +
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