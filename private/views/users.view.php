<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="card-group justify-content-center">
        <?php foreach($rows as $row):?>
        <div class="card m-2" style="width: 15rem;">
            <img src="<?= ASSETS ?>/user_female.png" class="card-img-top" style="width:14rem" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$row->first_name?> <?=$row->last_name?></h5>
                <p class="card-text">Rank:<?=str_replace("_"," ",$row->rank)?></p>
                <a href="#" class="btn btn-primary">Profile</a>
            </div>
        </div>
        <?php endforeach;?>
    
    </div>

</div>


<?php $this->view('includes/footer') ?>