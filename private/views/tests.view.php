<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]); ?>
    <nav class="navbar navbar-light bg-light">
                <a href="<?= ROOT ?>/tests /add"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a>
            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <button class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></button>
                    <input name="find" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>
      
         <?php include(views_path('tests'));?>
    </div>
</div>


<?php $this->view('includes/footer') ?>