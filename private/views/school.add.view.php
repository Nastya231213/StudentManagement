<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="card-group justify-content-center">
        <form method="post">
            <h3>Add New School</h3>
            <?php if(count($errors)>0):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong> 
                <?php foreach($errors as $error):?>
                <br><?= $error?>
                <?php endforeach;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>
            <input autofocus class="form-control" value="<?= get_var('school') ?>" type="text" name="school" placeholder="School Name"><br><br>
            <input class="btn btn-primary float-end" type="submit" value="Create">
            <a href="<?= ROOT ?>/schools">
                <input class="btn btn-warning" type="submit" value="Cancel">
            </a>
        </form>
    </div>

</div>


<?php $this->view('includes/footer') ?>