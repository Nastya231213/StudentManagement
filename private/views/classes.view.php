<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]); ?>
    <nav class="navbar navbar-light bg-light">
                <a href="<?= ROOT ?>/classes/add"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a>
            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <button class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></button>
                    <input name="find" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>
      
         <?php include(views_path('classes'));?>
    </div>
</div>

<table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Class Name</th>
            <th>Created by</th>
            <th>Date</th>
            <th>
               
            </th>

        </tr>
        <?php if (isset($rows) && is_array($rows) && count($rows) > 0) : ?>

            <?php foreach ($rows as $row) : ?>
                <tr>

                    <td>
                        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>"><button class="btn btn-primary"><i class="fa fa-chevron-right"></i></button></a>
                    </td>
                    <td><?= $row->class ?></td>
                    <td><?= $row->user->first_name ?> <?= $row->user->last_name ?></td>
                    <td><?= get_date($row->date) ?></td>
                    <td>
                    <?php echo Auth::access('lecturer');?>
                        <?php if (Auth::access('lecturer')) : ?>
                            <a href="<?= ROOT ?>/classes/edit/<?= $row->id ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/classes/delete/<?= $row->id ?>">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                <tr>
                <?php endforeach; ?>
            <?php else : ?>
    
 <tr><td colspan="5"><center> No classes were found at this time</center></td></tr>

<?php endif; ?></table>
<?php $this->view('includes/footer') ?>