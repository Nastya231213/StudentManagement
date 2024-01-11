<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="card-group justify-content-center p-3">
        <form method="post">
            <h3>Are you sure you want to delete?</h3>
            <br>
            <?php if($row):?>
   
            <input autofocus class="form-control" value="<?= get_var('school',$row->school) ?>" type="text" name="school" placeholder="School Name"><br><br>
           <input name="id" type="hidden">
            <input class="btn btn-danger float-end" type="submit" value="Delete">
            <a href="<?= ROOT ?>/schools">
                <input class="btn btn-warning" type="submit" value="Cancel">
            </a>
            <?php else:?>
            The school wasn't found!

                <?php endif;?>
        </form>
        
    </div>

</div>


<?php $this->view('includes/footer') ?>