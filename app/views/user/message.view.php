<div class="blog-area section-padding-0-100 mt-50">
    <div class="container">

        <?php if (isset($message) && $message != null) : ?>
        <div class="content-wrapper">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">SUPPORT MESSAGE</h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $message->message_id ?></td>
                            <td><?= $message->name ?></td>
                            <td><?= $message->email ?></td>
                            <td><?= $message->subject ?></td>
                            <td><?= date('F d, Y', strtotime($message->date)) ?></td>
                            <?php $status = ($message->status == 0) ? 'No Admin Responded' : 'Admin Responded'; ?>
                            <td><?= $status ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Discussion</h3>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="chat" id="chat-ul">

                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="<?= IMAGES_DIR ?>users-img/customer.png" alt="User Avatar" style="height:44px;width:50px" class="img-circle" />
                                </span>

                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><i class="fa fa-clock-o"></i><?= $message->date ?></small>
                                        <strong class="pull-right primary-font"><?= $message->name ?></strong>
                                    </div>

                                    <p><?= $message->message ?></p>
                                </div>
                            </li>

                            <?php if (isset($replies) && $replies != false) : ?>
                                <?php foreach ($replies as $reply) : ?>
                                    <?php if ($reply->sender == 'admin') : ?>
                                        <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                             <img src="<?= IMAGES_DIR ?>users-img/admin.png" alt="User Avatar" style="height:44px;width:50px" class="img-circle" />
                                        </span>

                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font"><?= $reply->name ?></strong>
                                                    <small class="pull-right text-muted"><i class="fa fa-clock-o"></i><?= $reply->date ?></small>
                                                </div>
                                                <p><?= $reply->message ?></p>
                                            </div>
                                        </li>
                                    <?php else : ?>
                                        <li class="right clearfix">
                                        <span class="chat-img pull-right">
                                            <img src="<?= IMAGES_DIR ?>users-img/customer.png" alt="User Avatar" style="height:44px;width:50px" class="img-circle" />
                                        </span>

                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <small class=" text-muted"><i class="fa fa-clock-o"></i><?= $reply->date ?></small>
                                                    <strong class="pull-right primary-font"><?= $reply->name ?></strong>
                                                </div>

                                                <p><?= $reply->message ?></p>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </ul>
                    </div>

                    <div class="panel-footer">
                        <form method="post" id="chat-form" >
                            <div class="input-group">
                                <input id="btn-input" required name="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />

                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-sm" name="send" id="btn-chat">Send</button>
                                </span>
                            </div>
                        </form>
                        <script>document.getElementById("chat-form").addEventListener("submit", SendMessage("<?= $message->message_id ?>"));</script>
                    </div>

                </div>
            </div>

        </section>
    </div>
    </div>
</div>
<style>
    .content-wrapper {font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
        font-weight: 400;font-size: 14px;line-height: 1.42857143;color: #333;}
    .box {position: relative;border-radius: 3px;background: #ffffff;
        border-top: 3px solid #d2d6de;margin-bottom: 20px;width: 100%;box-shadow: 0 1px 1px rgba(0,0,0,0.1)}

    .box.box-primary {border-top-color: #3c8dbc}
    .box-header {color: #444;display: block;padding: 10px;position: relative}
    .box-header.with-border {border-bottom: 1px solid #f4f4f4}
    .box-header .box-title {display: inline-block;font-size: 18px;margin: 0;line-height: 1}
    .box-header:after,.box-body:after {clear: both}
    .box-body {border-top-left-radius: 0;border-top-right-radius: 0;
        border-bottom-right-radius: 3px;border-bottom-left-radius: 3px;padding: 0 10px}
    .box-body>.table {margin-bottom: 0;background-color: transparent;border-spacing: 0;border-collapse: collapse;}
    .table>thead>tr>th {border-bottom: 2px solid #f4f4f4;}
    .table-striped>tbody>tr:nth-of-type(odd) {background-color: #f9f9f9;}
    .table>tbody>tr>td, .table>tfoot>tr>td {border-top: 1px solid #f4f4f4;}

    .panel {margin-bottom: 20px;background-color: #fff;border: 1px solid transparent;border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);}
    .panel-primary {border-color: #bdbdbd;}
    .panel-body {overflow-y: scroll;height: 250px;padding: 15px;}
    .panel-footer {padding: 10px 15px;background-color: #f5f5f5;
        border-top: 1px solid #ddd;border-bottom-right-radius: 3px;border-bottom-left-radius: 3px;}

    .chat {list-style: none;margin: 0;padding: 0;}
    .chat li {margin-bottom: 10px;padding-bottom: 5px;border-bottom: 1px dotted #B3A9A9;}
    .img-circle {border-radius: 50%;}
    .chat li.left .chat-body {margin-left: 60px;}
    .chat li.right .chat-body {margin-right: 60px;}
    .chat li .chat-body i {margin-right: 5px}
    .chat li .chat-body p {margin: 0;color: #777777;width: 100%;padding: 10px 0;font-size: 14px;line-height: 1.42857143;}

    .input-sm {font-size: 12px;line-height: 1.5;}
    .input-sm:focus {box-shadow: none}
    .btn {margin-bottom: 0;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;
        -webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;
        border-radius: 3px;-webkit-box-shadow: none;box-shadow: none;border: 1px solid transparent;padding: 7px 15px}
    .input-group-btn:last-child>.btn {z-index: 2;margin-left: -1px;}
    .btn-primary {background-color: #3c8dbc;border-color: #367fa9;}

    ::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);background-color: #F5F5F5;}
    ::-webkit-scrollbar {width: 12px;background-color: #F5F5F5;}
    ::-webkit-scrollbar-thumb {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);background-color: #555;}
</style>
<?php endif; ?>