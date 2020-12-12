<!-- ##### Blog Area Start ##### -->
<div class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="palatin-blog-posts">

                    <?php if (isset($post) && $post !== false) : ?>
                            <!-- ##### Single Blog Post ##### -->
                            <div class="single-blog-post mb-100 wow fadeInUp" data-wow-delay="100ms">
                                <!-- Post Thumb -->
                                <div class="blog-post-thumb">
                                    <img src="<?= IMAGES_DIR ?>blog-img/<?= $post->image ?>" alt="">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content" style="min-height: 450px">
                                    <!-- Post Date-->
                                    <a href="<?= HOST_NAME . 'index/post/' . $post->post_id ?>" class="post-date btn palatin-btn"><?= date('F d, Y', strtotime($post->date)) ?></a>
                                    <!-- Post Title -->
                                    <a href="<?= HOST_NAME . 'index/post/' . $post->post_id ?>" class="post-title"><?= $post->title ?></a>
                                    <!-- Post Meta -->
                                    <div class="post-meta d-flex justify-content-center">
                                        <a href="#" class="post-catagory"><?= $post->place ?></a>
                                        <a href="#" class="post-comments"><?= $post->views ?> Views</a>
                                    </div>
                                    <!-- Post Excerpt -->
                                    <p><?= $post->description ?></p>
                                </div>
                            </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->