<?php if (isset($user) && $user != null) : ?>

<div class="col-md-12">    
    <a href="<?= HOST_NAME . 'admin/edituser/' . $user->user_id ?>" class="btn btn-primary btn-lg btn-block">Edit Profile</a>
    <br><br>
</div>
<div class="col-md-12">
    <aside class="profile-nav alt">
        <section class="card">
            <div class="card-header user-header alt bg-dark">
                <div class="media">
                    <a href="#">
                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?= IMAGES_DIR ?>users-img/admin.png">
                    </a>
                    <div class="media-body">
                        <h2 class="text-light display-6"><?= $user->fullname ?></h2>
                        <p>Adminstrator</p>
                    </div>
                </div>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="fa fa-envelope-o"></i> Username <span class="badge badge-primary pull-right"><?= $user->username ?></span></a>
                </li>
                <li class="list-group-item">
                    <i class="fa fa-envelope-o"></i> Mail Inbox <span class="badge badge-success pull-right"><?= $user->email ?></span></a>
                </li>
                <li class="list-group-item">
                    <i class="fa fa-tasks"></i> Phone Number <span class="badge badge-danger pull-right"><?= $user->phone ?></span></a>
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
<?php endif; ?>
<style type="text/css">
    .list-group .list-group-item {color: #878787;}
    .list-group .list-group-item:hover {color: #444444}
</style>