<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="max-width:1000px;">
    <?php $this->view('includes/crumbs',['crumbs'=>$crumbs]); ?>

<nav class="navbar navbar-light bg-light">
<a href="<?= ROOT ?>/signup"><button type="button"class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a>

            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <button class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></button>
                    <input name="find" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>
    <div class="card-group justify-content-center">
        <?php if(is_array($rows)):?>
        <?php foreach($rows as $row):?>
          
            <?php include(views_path('user'));?>
    
        
        <?php endforeach;?>
        <?php else:?>
                  <h4>No staff members were found at this time</h4> 
        <?php endif?>
    
    </div>

</div>


<?php $this->view('includes/footer') ?>