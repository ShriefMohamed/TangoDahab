<?php if (isset($contactinfo) && $contactinfo != null) : ?>
<div class="card">
    <div class="card-header">
        <strong class="card-title">Manage Contact Info</strong>
    </div>

    <div class="card-body">
        <div class="alert alert-success" role="alert">

            <h4 class="alert-heading">Phone Number</h4>
            <p>+<?= $contactinfo->phone ?></p>

            <h4 class="alert-heading">Contact Email</h4>
            <p><?= $contactinfo->email ?></p>

            <h4 class="alert-heading">Address</h4>
            <p><?= $contactinfo->address ?></p>

            <hr>
            <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#scrollmodal">
              Edit Contact Info
            </button>
        </div>
    </div>


   <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Update Contact Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form method="post" class="form-horizontal">
      
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="phone" class=" form-control-label">Phone Number</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="password-input" name="phone" placeholder="<?= $contactinfo->phone ?>" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="email" class=" form-control-label">Contact Email</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="<?= $contactinfo->email ?>" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="address" class=" form-control-label">Address</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="address-input" name="address" placeholder="<?= $contactinfo->address ?>" class="form-control"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="id" value="<?= $contactinfo->id ?>">
                        <button type="submit" name="submit1" class="btn btn-primary">Confirm</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>