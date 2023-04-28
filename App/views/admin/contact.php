<?php view('admin/partials/header'); ?>

    <div class="container my-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($contacts as $data): ?>
                <tr>
                    <td><?= $data->name ?></td>
                    <td><?= $data->email ?></td>
                    <td><?= $data->subject ?></td>
                    <td><?= $data->message ?></td>
                    <td>
                        <form action="<?= url('/admin/contact-delete/'.$data->id) ?>" method="post">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>


<?php view('admin/partials/footer'); ?>




