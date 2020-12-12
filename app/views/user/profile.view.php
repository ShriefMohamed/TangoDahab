<?php if (isset($user) && $user != null) : ?>
<div class="blog-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header user-header alt">
                            <div class="media">
                                <a href="#">
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?= IMAGES_DIR ?>users-img/admin.png">
                                </a>
                                <div class="media-body">
                                    <h2 class="text-dark display-6"><?= $user->fullname ?></h2>
                                </div>
                                <div class="right">
                                    <a href="<?= HOST_NAME . 'user/editprofile/' ?>" style="font-size: 14px" class="btn btn-primary btn-lg btn-block">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                        <style>
                            .list-group-flush li span {padding: 10px 15px;font-size: 85%;}
                        </style>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o"></i> Username <span class="badge badge-warning pull-right"><?= $user->username ?></span></a>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-envelope-o"></i> Mail Inbox <span class="badge badge-warning pull-right"><?= $user->email ?></span></a>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-tasks"></i> Phone Number <span class="badge badge-warning pull-right"><?= $user->phone ?></span></a>
                            </li>

                            <li class="list-group-item">
                                <i class="fa fa-comments-o"></i> Governorate <span class="badge badge-warning pull-right r-activity"><?= $user->governorate ?></span></a>
                            </li>

                            <?php $date = explode(' ', $user->created); ?>
                            <li class="list-group-item">
                                <i class="fa fa-comments-o"></i> Member Since <span class="badge badge-warning pull-right r-activity"><?= $date[0] ?></span></a>
                            </li>
                        </ul>

                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
<style type="text/css">
    .list-group .list-group-item {color: #878787;}
    .list-group .list-group-item:hover {color: #444444}
</style>