<?php if (isset($aboutus) && $aboutus != null) : ?>
<div class="card">
    <div class="card-header">
        <strong class="card-title">Manage About Us</strong>
    </div>

    <div class="card-body">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">About Us</h4>
            <p><?= $aboutus->content ?></p>
            <hr>
            <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#scrollmodal">
              Edit About Us
            </button>
        </div>
    </div>


   <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Update About Us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form method="post" class="form-horizontal" name="aboutus">
                    <div class="row form-group">
                        <div class="col-12 col-md-9">
                            <textarea name="aboutus-edit" id="textarea-input" rows="9" placeholder="<?= $aboutus->content ?>" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>