<?php if (isset($user) && $user != null) : ?>
<div class="card">
  <div class="card-header">
    Edit User:<strong> <?= $user->fullname ?></strong>
  </div>
  <div class="card-body card-block">
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div id="add-user-form-group-container" class="col-md-6">
          <div class="row form-group">
              <label for="name" class=" form-control-label">Full Name</label>
              <input type="text" id="text-input" name="fullname" placeholder="<?= $user->fullname ?>" class="form-control">
              <small class="form-text text-muted">Please enter the full name.</small>
          </div>
          <div class="row form-group">
              <label for="username" class=" form-control-label">Username</label>
              <input type="text" id="text-input" name="username" placeholder="<?= $user->username ?>" class="form-control">
              <small class="form-text text-muted">Please enter the username.</small>
          </div>
          <div class="row form-group">
              <label for="email" class=" form-control-label">Email</label>
              <input type="email" id="email-input" name="email" placeholder="<?= $user->email ?>" class="form-control">
              <small class="help-block form-text">Please enter the email.</small>
          </div>
          <div class="row form-group">
              <label for="password" class=" form-control-label">Password</label>
              <input type="password" id="password-input" name="password" placeholder="Password" class="form-control"><small class="help-block form-text">Please enter a complex password.</small>
          </div>
          <div class="row form-group">
              <label for="phone" class=" form-control-label">Phone</label>
              <input type="number" id="password-input" name="phone" placeholder="<?= $user->phone ?>" class="form-control"><small class="help-block form-text">Please enter the phone number.</small>
          </div>
          <div class="row form-group">
              <label for="country" class=" form-control-label">Select Governorate</label>
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

        <?php if ($user->role == 'admin' && isset($privileges) && $privileges != null) : ?>
            <?php
            $rooms_management = ($privileges->rooms_management == 1) ? 'checked' : null;
            $users_management = ($privileges->users_management == 1) ? 'checked' : null;
            $messages_management = ($privileges->messages_management == 1) ? 'checked' : null;
            $news_management = ($privileges->news_management == 1) ? 'checked' : null;
            $testimonials_management = ($privileges->testimonials_management == 1) ? 'checked' : null;
            $website_settings_management = ($privileges->website_settings_management == 1) ? 'checked' : null;
            $view_reservations = ($privileges->view_reservations == 1) ? 'checked' : null;
            $add_reservations = ($privileges->add_reservations == 1) ? 'checked' : null;
            $update_reservations = ($privileges->update_reservations == 1) ? 'checked' : null;
            $logs = ($privileges->logs == 1) ? 'checked' : null;
            ?>
            <div class="col-md-5" id="privileges-form-group-container">
                <div class="box-header">
                    <h3 class="box-title">Access Authorizations</h3>
                </div>


                <div class="checkbox">
                    <label>
                        <input type="hidden" name="rooms_management" value="2">
                        <input type="checkbox" name="rooms_management" value="1" <?= $rooms_management ?>>
                        Manage Rooms (Add - Delete - Update)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="users_management" value="2">
                        <input type="checkbox" name="users_management" value="1" <?= $users_management ?>>
                        Manage Users / Admins (Add - Delete - Update)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="messages_management" value="2">
                        <input type="checkbox" name="messages_management" value="1" <?= $messages_management ?>>
                        Manage Messages (Send - Reply - Delete)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="news_management" value="2">
                        <input type="checkbox" name="news_management" value="1" <?= $news_management ?>>
                        Manage News (Add - Delete - Update)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="testimonials_management" value="2">
                        <input type="checkbox" name="testimonials_management" value="1" <?= $testimonials_management ?>>
                        Manage Testimonials (Add - Delete)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="website_settings_management" value="2">
                        <input type="checkbox" name="website_settings_management" value="1" <?= $website_settings_management ?>>
                        Manage Website Settings (Contact info - About us - Subscribers - Terms & Conditions)
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="view_reservations" value="2">
                        <input type="checkbox" name="view_reservations" value="1" <?= $view_reservations ?>>
                        View Reservations
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="add_reservations" value="2">
                        <input type="checkbox" name="add_reservations" value="1" <?= $add_reservations ?>>
                        Add & Delete Reservations
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="update_reservations" value="2">
                        <input type="checkbox" name="update_reservations" value="1" <?= $update_reservations ?>>
                        Update Reservations
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="logs" value="2">
                        <input type="checkbox" name="logs" value="1" <?= $logs ?>>
                        View Website Logs
                    </label>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-12 add-user-footer">
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

<style>
        #add-user-form-group-container {margin: 0 16px;}
        #add-user-form-group-container label {font-weight: 700; color: #444; font-size: 14px; line-height: 1.42857143;}
        #privileges-form-group-container .box-header {border-bottom: 1px solid #f4f4f4;color: #444;
            display: block;padding: 10px;margin-left: 20px;margin-bottom: 10px;}
        #privileges-form-group-container .box-header .box-title {font-size: 18px;line-height: 1;margin-left: -10px;}
        #privileges-form-group-container .checkbox label {color: #444;min-height: 20px;padding-left: 20px;
            margin-bottom: 0;font-weight: 400;cursor: pointer;font-size: 14px;}
        .add-user-footer {padding: 0.65rem 1.25rem;background-color: #f0f3f5;border-top: 1px solid #c2cfd6;}
        .add-user-footer:last-child {border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px);}
    </style>
<?php endif; ?>
