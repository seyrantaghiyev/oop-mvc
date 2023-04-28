<?php view('admin/partials/header'); ?>

<div class="container my-2">
    <form action="<?= $blog ? url('/admin/blog/'.$blog->id) : url('/admin/blog') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= $blog->title ?? '' ?>" placeholder="title" class="form-control my-2">
        <input type="text" name="slug" value="<?= $blog->slug ?? '' ?>" placeholder="slug" class="form-control my-2">
        <textarea class="form-control my-2" placeholder="text" name="text" id="" cols="30" rows="10"><?= $blog->text ?? '' ?></textarea>
        <?php
        if($blog->image ?? ''){
            ?>
            <img width="200" src="<?= img($blog->image ?? '') ?>" alt=""></img>
            <?php
        }

        ?>
        <input class="form-control my-2" type="file" name="image" >
        <button class="btn btn-sm btn-primary">Save</button>
    </form>
</div>

<?php view('admin/partials/footer'); ?>
