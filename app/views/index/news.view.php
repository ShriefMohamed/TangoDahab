<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="palatin-blog-posts">

                    <?php if (isset($news) && $news !== false) : ?>
                    <?php foreach ($news as $post) : ?>
                    <!-- ##### Single Blog Post ##### -->
                    <div class="single-blog-post mb-100 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Post Thumb -->
                        <div class="blog-post-thumb">
                            <img src="<?= IMAGES_DIR ?>blog-img/<?= $post->image ?>" alt="">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
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
                            <p><?= substr($post->description, 0, 320) ?>....</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-12">
                <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="700ms">
                    <a href="#" class="btn palatin-btn">Load More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->