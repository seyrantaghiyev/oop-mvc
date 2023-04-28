<?php view('partials/header'); ?>

<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                        <a href="<?= url('/blog/'.$blog->slug) ?>" class="block-20"
                           style="background-image: url(<?= img($blog->image ?? null) ?>);">
                        </a>
                        <div class="text mt-3 float-right d-block">
                            <h3 class="heading"><a href="<?= url('/blog/'.$blog->slug) ?>"><?= $blog->title ?></a></h3>
                            <p><?= mb_strimwidth($blog->text, '0', '200') ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php view('partials/footer'); ?>


