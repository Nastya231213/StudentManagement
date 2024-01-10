<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="card-group justify-content-center">
        <table class="table table-striped table-hover">
            <tr>
                <th>School</th><th>Created by</th>
                <th>Date</th><th>
                    <a href="<?=ROOT?>/schools/add"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a></th>
                    
            </tr>
        </table>
        <?php if ($rows) : ?>

            <?php foreach ($rows as $row) : ?>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>No schools were found at this time</h4>
        <?php endif; ?>

    </div>

</div>


<?php $this->view('includes/footer') ?>