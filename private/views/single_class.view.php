<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <?php $this->view('includes/crumbs'); ?>

    <?php if ($row) : ?>
        <div class="row">
            <center>
                <h5><?= esc(ucwords($row->class)) ?></h5>
            </center>
            <div class="col-sm-9 col-md-12 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">

                    <tr>
                        <th>Created by:</th>
                        <td><?= esc($row_user->first_name) ?> <?= esc($row_user->last_name) ?></td>

                        <th>Date Created:</th>
                        <td><?= esc(get_date($row->date)) ?></td>
                    </tr>
                </table>

            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'lecturers' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">Lecturers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'students' ? 'active' : '' ?>" href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Test</a>
                </li>
            </ul>

            <?php
            switch ($page_tab) {
                case 'lecturers':
                    include(views_path('class-tab-lecturers'));
                    break;
                case 'students':
                    include(views_path('class-tab-students'));

                    break;
                case 'tests':
                    include(views_path('class-tab-tests'));
                    break;
                case 'lecturers-add':
                    include(views_path('class-tab-lecturers-add'));
                    break;
                case 'lecturers-remove':
                    include(views_path('class-tab-lecturers-remove'));
                    break;
                case 'test-add':
                    include(views_path('class-tab-test-add'));
                    break;
                case 'test-remove':
                    include(views_path('class-tab-test-remove'));
                    break;
                case 'students-add':
                    include(views_path('class-tab-students-add'));
                    break;
                case 'students-remove':
                    include(views_path('class-tab-students-remove'));
                    break;
                case 'tests-add':
                    $this->view(views_path('class-tab-tests-add'));
                    break;
                default:
                    break;
            }



            ?>

        </div>
    <?php else : ?>
        <center>
            <h4>That class wasn't found!!!</h4>
        </center>
    <?php endif; ?>

</div>


<?php $this->view('includes/footer') ?>