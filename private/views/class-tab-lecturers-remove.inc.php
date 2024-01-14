<form method="post" class="form mx-auto mt-2" style="width:100%">
    <h4>Remove Lecturer</h4>

    <input value="<?= get_var('name') ?>" type="text" class="form-control mb-3" name="name" placeholder="Lecturer Name">
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">
        <input class="btn btn-danger" type="button" value="Cancel">
    </a>
    <button class="btn btn-primary float-end" name="search">Search</button>
    <div class="clearfix"></div>
</form>
<form method="post">
    <div class="container-fluid justify-content-center mt-3">

        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong>
                <?php foreach ($errors as $error) : ?>
                    <br><?= $error ?>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (is_array($results)) : ?>

            <?php
            foreach ($results as $row) : ?>
                <?php include(views_path('user')) ?>
            <?php endforeach ?>
            </table>
        <?php else : ?>
            <hr>
            <?php if (count($_POST) > 0 && count($errors) > 0) : ?>
                <center>
                    <h4>No members were found at this time</h4>
                </center>
            <?php endif; ?>
        <?php endif; ?>
</form>
</div>