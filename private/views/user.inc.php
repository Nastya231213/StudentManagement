<?php
$image = get_image($row);
?>


<div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
    <img src="<?= $image ?>" class="card-img-top" style="width:14rem">
    <div class="card-body">
        <h5 class="card-title"><?= $row->first_name ?> <?= $row->last_name ?></h5>
        <p class="card-text">Rank:<?= str_replace("_", " ", $row->rank) ?></p>
        <a href="<?= ROOT ?>/profile/<?= $row->url_address ?>" class="btn btn-primary">Profile</a>

        <?php if (isset($_GET['select'])) : ?>
            <a href="<?= ROOT ?>/signle_class/<?= $row->class_id?>?tab=lecturer-add&select=true" >  <button name="selected" value="<?=$row->url_address?>" class="float-end btn btn-danger">Select</button></a>
        <?php endif; ?>
    </div>
</div>