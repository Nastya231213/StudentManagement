<div class="card-group justify-content-center">

    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Test Name</th>
            <th>Created by</th>
            <th>Date</th>
            <th>
               
            </th>

        </tr>
        <?php echo count($tests)?>
        <?php if (isset($tests) && is_array($tests) && count($tests) > 0) : ?>

            <?php foreach ($tests as $row) : ?>
                <tr>

                    <td>
                        <a href="<?= ROOT ?>/test/<?= $row->test_id ?>"><button class="btn btn-primary"><i class="fa fa-chevron-right"></i></button></a>
                    </td>
                    <td><?= $row->test ?></td>
                    <td><?= $row->user->first_name ?> <?= $row->user->last_name ?></td>
                    <td><?= get_date($row->date) ?></td> 
                    <td>
                    <?php echo Auth::access('lecturer');?>
                        <?php if (Auth::access('lecturer')) : ?>
                            <a href="<?= ROOT ?>/test/edit/<?= $row->id ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/test/delete/<?= $row->id ?>">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                <tr>
                <?php endforeach; ?>
            <?php else : ?>
    
 <tr><td colspan="5"><center> No tests were found at this time</center></td></tr>

<?php endif; ?></table>
</div>