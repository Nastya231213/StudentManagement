<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="card-group justify-content-center p-3">
        <form method="post">
            <h3>Edit class</h3>
            <br>
            <?php if($row):?>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <br><?= $error ?>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <input autofocus class="form-control" value="<?= get_var('class',$row->class) ?>" type="text" name="class" placeholder="Class Name"><br><br>
            <input class="btn btn-primary float-end" type="submit" value="Create">
            <a href="<?= ROOT ?>/classes">
                <input class="btn btn-warning" type="submit" value="Cancel">
            </a>
            <?php else:?>
            The class wasn't found!

                <?php endif;?>
        </form>
        
    </div>

</div>


<?php $this->view('includes/footer') ?>