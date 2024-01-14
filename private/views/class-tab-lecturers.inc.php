<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
        </div>

    </form>
    <div> <a href="<?= ROOT ?>/single_class/lectureradd/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New Lecturer</button>
        </a>
        <a href="<?= ROOT ?>/single_class/lecturerremove/<?= $row->class_id ?>?select=true">
            <button class="btn btn-sm btn-primary"><i class="fa fa-minus"></i>Remove New Lecturer</button>
        </a>
    </div>

</nav>
<br>
<div class="card-group justify-content-center">

    <?php if (is_array($lecturers)) : ?>
        <?php foreach ($lecturers as $lecturer) : ?>
            <?php $row = $lecturer->user;
            ?>
            <?php include(views_path('user')) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>