<nav class="navbar navbar-light bg-light">
    <form class="form-inline" method="POST">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
        </div>

    
    </form>
    <a href="<?= ROOT ?>/single_class/testadd/<?=$row->class_id?>?tab=test-add">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Test</button>
    </a>
</nav>
<table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Class Name</th>
            <th>Created by</th>
            <th>Date</th>
            <th>
               
            </th>

        </tr>
        <?php if (isset($tests) && is_array($tests) && count($tests) > 0) : ?>

            <?php foreach ($tests as $row) : ?>
                <tr>

                    <td>
                        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>"><button class="btn btn-primary"><i class="fa fa-chevron-right"></i></button></a>
                    </td>
                    <td><?= $row->test ?></td>
                    <td><?= $row->user->first_name ?> <?= $row->user->last_name ?></td>
                    <td><?= get_date($row->date) ?></td>
                    <td>
                        <?php if (Auth::access('lecturer')) : ?>
                            <a href="<?= ROOT ?>/signle_class/testedit/<?= $row->id ?>">
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
    
 <tr><td colspan="5"><center> No tests were found at this time</center></td></tr>

<?php endif; ?></table>