<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
        </div>

    </form>
    <div> <a href="<?= ROOT ?>/single_class/studentadd/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New Student</button>
        </a>
        <a href="<?= ROOT ?>/single_class/studentremove/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-minus"></i>Remove New Student</button>
        </a>
    </div>

</nav>
<br>
<form method="post">


    <div class="card-group justify-content-center">

        <?php if (is_array($students) && count($students) > 0) : ?>
            <?php foreach ($students as $student) : ?>
                <?php $row = $student->user;
                ?>
                <?php include(views_path('user')) ?>
            <?php endforeach; ?>
        <?php else : ?>
            <h3>No students were found here</h3>
        <?php endif ?>
    </div>

</form>