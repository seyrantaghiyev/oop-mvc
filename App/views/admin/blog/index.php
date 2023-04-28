<?php view('admin/partials/header'); ?>

    <div class="container my-2">
        <a class="btn btn-sm btn-primary" href="<?= url('/admin/blog/create') ?>">Add Blog</a>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>slug</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($blogs as $blog): ?>
                <tr>
                    <td><?= $blog->id ?></td>
                    <td><?= $blog->title ?></td>
                    <td><?= $blog->slug ?></td>
                    <td>
                        <a href="<?= url('/admin/blog/' . $blog->id) ?>">Edit</a>
                    </td>
                    <td>
                        <form action="<?= url('/admin/blog-delete/'.$blog->id) ?>" method="post">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>


<?php view('admin/partials/footer'); ?>
