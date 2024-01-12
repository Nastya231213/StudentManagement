<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    
    <?php if($row):?>
    <div class="row">
      <center><h5><?=esc(ucwords($row->class))?></h5></center>
        <div class="col-sm-9 col-md-10 bg-light p-2">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Class Name:</th>
                    <td><?= esc($row->class)?></td>
                </tr>
                <tr>
                    <th>Created by:</th>
                    <td><?= esc($row_user->first_name)?> <?=esc($row_user->last_name)?></td>
                </tr>
                <tr>
                    <th>Date Created:</th>
                    <td><?=esc(get_date($row->date))?></td>
                </tr>
            </table>

        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?=$page_tab=='lecturers'?'active':''?>" aria-current="page" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=lecturers">Lecturers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$page_tab=='students'?'active':''?>" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=students">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$page_tab=='tests'?'active':''?>" href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">Test</a>
            </li>
        </ul>
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>

    </div>
    <?php else: ?>
       <center> <h4>That class wasn't found!!!</h4></center>
        <?php endif;?>

</div>


<?php $this->view('includes/footer') ?>