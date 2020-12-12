<?php if (isset($news) && $news != false) : ?>
    <div class="card">
        <div class="card-header">
            Edit <strong>Post</strong>
        </div>
        <div class="card-body card-block">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="title" class=" form-control-label">Title</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="title" placeholder="<?= $news->title ?>" class="form-control"><small class="form-text text-muted">Please enter the article's title.</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="description" class=" form-control-label">Description</label></div>
                    <div class="col-12 col-md-9">
                        <textarea id="text-input" name="description" placeholder="<?= $news->description ?>" class="form-control"></textarea><small class="form-text text-muted">Please enter the description.</small>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col col-md-3"><label for="place" class=" form-control-label">Place</label></div>
                    <div class="col-12 col-md-9">
                        <input type="text" name="place" placeholder="<?= $news->place ?>" class="form-control"><small class="form-text text-muted">Please enter where the event will take place.</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="date" class=" form-control-label">Date</label></div>
                    <div class="col-12 col-md-9">
                        <input type="date" name="date" placeholder="<?= $news->date ?>" class="form-control"><small class="form-text text-muted">Please select the date of te event.</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="image" class=" form-control-label">Image</label></div>
                    <div class="col-12 col-md-9" id="image-input-form-group">
                        <?php if ($news->image != " ") : ?>
                            <img onclick="replaceImageWithInput('<?= $news->post_id ?>')" id="testimonial-image-element" src="<?= IMAGES_DIR . 'blog-img' . $news->image ?>">
                        <?php else: ?>
                            <input type='file' name='image'/>
                        <?php endif; ?>

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

<?php endif; ?>