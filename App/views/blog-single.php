<?php view('partials/header'); ?>
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-md-last ftco-animate py-md-5 mt-md-5">
                <h2 class="mb-3"><?= $blog->title; ?></h2>
                <p><?= $blog->text ?></p>
                <p>
                    <img src="<?= img($blog->image) ?>"" class="img-fluid">
                </p>
<!--               -->
                <div class="tag-widget post-tag-container mb-5 mt-5">
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">Life</a>
                        <a href="#" class="tag-cloud-link">Sport</a>
                        <a href="#" class="tag-cloud-link">Tech</a>
                        <a href="#" class="tag-cloud-link">Travel</a>
                    </div>
                </div>
            </div>
<!--               -->
</section> <!-- .section -->
<?php view('partials/footer'); ?>
