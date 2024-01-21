<nav class="navbar navbar-light bg-light">
    <form class="form-inline" method="POST">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
        </div>

    <a href="<?= ROOT ?>/single_class/testadd/<?=$row->class_id?>?tab=test-add">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Test</button>
    </a>
    </form>

</nav>
