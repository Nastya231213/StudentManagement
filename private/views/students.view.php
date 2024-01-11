<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="max-width:1000px;">
    <?php $this->view('includes/crumbs',['crumbs'=>$crumbs]); ?>

<nav class="navbar navbar-light bg-light">
<a href="<?= ROOT ?>/signup?mode=<?=$mode?>"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a>

            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>
    <div class="card-group justify-content-center">
        <?php if(is_array($rows)):?>
        <?php foreach($rows as $row):?>
            <?php 
                $image=get_image($row);
            ?>
				<div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
            <img src="<?=$image?>" class="card-img-top" style="width:14rem" >
            <div class="card-body">
                <h5 class="card-title"><?=$row->first_name?> <?=$row->last_name?></h5>
                <p class="card-text">Rank:<?=str_replace("_"," ",$row->rank)?></p>
                <a href="<?=ROOT?>/profile/<?=$row->url_address?>" class="btn btn-primary">Profile</a>
            </div>
        </div>
    
        
        <?php endforeach;?>
        <?php else:?>
                  <h4>No staff members were found at this time</h4> 
        <?php endif?>
    
    </div>

</div>


<?php $this->view('includes/footer') ?>