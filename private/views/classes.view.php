<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>


<div class="container-fluid mx-auto shadow rounded" style="width:1000px;">
    <?php $this->view('includes/crumbs',['crumbs'=>$crumbs]); ?>
    <div class="card-group justify-content-center">

        <h5>Classes</h5>
        <br><br>

        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Class Name</th>
                <th>Created by</th>
                <th>Date</th>
                <th>
                    <a href="<?= ROOT ?>/classes/add"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button></a>
                </th> 

            </tr>
            <?php if (is_array($rows)) : ?>

                <?php foreach ($rows as $row) : ?>
                    <tr>

                    <td>
                        <a href="<?=ROOT?>/single_class/<?=$row->class_id?>"><button class="btn btn-primary"><i class="fa fa-chevron-right"></i></button></a></td>
                        <td><?= $row->class ?></td>
                        <td><?= $row->user->first_name?> <?= $row->user->last_name?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a href="<?=ROOT?>/classes/edit/<?= $row->id ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT?>/classes/delete/<?= $row->id ?>">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                      
                        </td>
                    <tr>
                    <?php endforeach; ?>

        </table>

                <?php else : ?>
                    <h4>No classes were found at this time</h4>
                <?php endif; ?>
    </div>

</div>


<?php $this->view('includes/footer') ?>