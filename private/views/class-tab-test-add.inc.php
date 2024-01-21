<div class="card-group justify-content-center p-3">
    <form method="post">
        <h3>Add New Test</h3>
        <br>
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong>
                <?php foreach ($errors as $error) : ?>
                    <br><?= $error ?>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <input autofocus class="form-control" value="<?= get_var('test') ?>" type="text" name="test" placeholder="Text Title Name"><br><br>
        <textarea name="description" class="form-control" value="<?= get_var('description'); ?>" placeholder="Add a description for thi test"></textarea><br><br>
    
    <a href="<?= ROOT ?>/single_class/testadd/<?=$row->class_id?>?tab=test-add">

        <input class="btn btn-primary float-end " type="submit" value="Create">
    </a>
    <a href="<?= ROOT ?>/tests">
        <input class="btn btn-warning" type="button" value="Cancel">
    </a>
    </form>
</div>

</div>