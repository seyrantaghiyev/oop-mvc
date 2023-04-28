<?php view('admin/partials/header'); ?>

<div class="container my-2">
    <form action="<?= url('/admin/slider') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= $slider->title ?? '' ?>" placeholder="title" class="form-control my-2">
        <textarea class="form-control my-2" placeholder="text" name="text" id="" cols="30" rows="10"><?= $slider->text ?? '' ?></textarea>
        <?php
        if($slider->image ?? ''){
            ?>
            <img width="200" src="<?= img($slider->image ?? '') ?>" alt=""></img>
            <?php
        }

        ?>
        <input class="form-control my-2" type="file" name="image" >
        <button class="btn btn-sm btn-primary">Save</button>
    </form>
</div>

<?php view('admin/partials/footer'); ?>
