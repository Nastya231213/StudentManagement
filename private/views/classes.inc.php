<div class="card-group justify-content-center">

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
    </table>
    <h4>No classes were found at this time</h4>

<?php endif; ?>
</div>