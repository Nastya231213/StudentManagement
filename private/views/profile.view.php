<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <?php if ($row) : ?>
        <div class="row">
            <div class="col-sm-3 col-md-4">
                <img src="<?= ASSETS ?>/user_male.png" class="d-block border border-dark mx-auto rounded-circle" style="width:100px;">
                <h3 class="text-center"><?= esc($row->first_name) ?> <?= esc($row->last_name) ?></h3>
                <br>
                <div class="text-center">
                    
                <a href="<?= ROOT ?>/profile/edit/<?= $row->url_address ?>">
                                <button class="btn btn-sm btn-success"><i class="fa fa-edit">Edit prfile</i></button>
                            </a>
                            <a href="<?= ROOT ?>/profile/delete/<?= $row->id ?>">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </a>
                </div>
            </div>
            <div class="col-sm-9 col-md-8 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>Fisrt Name:</th>
                        <td><?= esc($row->first_name) ?></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><?= esc($row->last_name) ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?= esc($row->email) ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?= esc($row->gender) ?></td>
                    </tr>
                    <tr>
                        <th>Rank:</th>
                        <td><?= esc(ucwords(str_replace("_", " ", $row->rank))) ?></td>
                    </tr>
                    <tr>
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
                    <a class="nav-link <?= $page_tab == 'info' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>/profile/<?= $row->url_address ?>">Basic Info</a>
                </li>
                <?php if (Auth::access('lecturer') || Auth::i_own_content($row)) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_tab == 'classes' ? 'active' : '' ?>" href="<?= ROOT ?>/profile/<?= $row->url_address ?>?tab=classes">My Classes</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="<?= ROOT ?>/profile/<?= $row->url_address ?>?tab=tests">Test</a>
                </li>
            </ul>

            <?php
            switch ($page_tab) {
                case 'info':
                    include(views_path('profile-tab-info'));
                    break;
                case 'classes':
                    if (Auth::access('lecturer') || Auth::i_own_content($row)) {
                        include(views_path('profile-tab-classes'));
                    } else {
                        include(views_path('access-denied'));
                    }
                    break;
                case 'tests':
                    include(views_path('profile-tab-tests'));

                    break;
                default:
                    break;
            }
            ?>

        </div>
    <?php else : ?>
        <center>
            <h4>That profile doesn't exist</h4>
        </center>
    <?php endif; ?>

</div>


<?php $this->view('includes/footer') ?>