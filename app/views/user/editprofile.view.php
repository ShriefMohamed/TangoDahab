<?php if (isset($user) && $user != null) : ?>
<div class="blog-area section-padding-0-100 mt-50">
    <div class="container">
        <div class="card">
          <div class="card-header"><strong>Update Profile</strong></div>
            <div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="name" class=" form-control-label">Full Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="fullname" placeholder="<?= $user->fullname ?>" class="form-control"><small class="form-text text-muted">Please enter the full name.</small></div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="username" class=" form-control-label">Username</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="username" placeholder="<?= $user->username ?>" class="form-control"><small class="form-text text-muted">Please enter the username.</small></div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="email" class=" form-control-label">Email</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="<?= $user->email ?>" class="form-control"><small class="help-block form-text">Please enter the email.</small></div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password" class=" form-control-label">Password</label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control"><small class="help-block form-text">Please enter a complex password.</small></div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="phone" class=" form-control-label">Phone</label></div>
                        <div class="col-12 col-md-9"><input type="number" id="password-input" name="phone" placeholder="<?= $user->phone ?>" class="form-control"><small class="help-block form-text">Please enter the phone number.</small></div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="country" class=" form-control-label">Select Governorate</label></div>
                        <div class="col-12 col-md-9">
                            <select name="country" id="select" class="form-control">
                                <?php if (isset($countries) && $countries != null) : ?>
                                    <?php for ($i=0; $i < sizeof($countries); $i++) : ?>
                                        <?php if ($countries[$i] == $user->governorate) : ?>
                                            <option selected value="<?= $countries[$i] ?>"><?= $countries[$i] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $countries[$i] ?>"><?= $countries[$i] ?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
