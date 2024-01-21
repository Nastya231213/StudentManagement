<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>
<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <center>
        <h4 class="mb-5">Edit Profile</h4>
    </center>

    <?php if ($row) : ?>

        <form method="POST" enctype="multipart/form-data">
            <?php $image = get_image($row->image, $row->gender);
            ?>
            <div class="row">

                <div class="col-sm-3 col-md-4 ">
                    <img src="<?=$image?>" class="d-block border border-dark mx-auto rounded-circle" style="width:150px;" />
                    <h3 class="text-center mt-2"><?= esc($row->first_name) ?> <?= esc($row->last_name) ?></h3>
                    <br>
                    <div class="text-center">
                        <label for="image_browser" class="btn-sm btn btn-info text-white">

                            <input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file" name="image" class="btn btn-primary" style="display:none;">
                            Browse Image
                        </label>
                        <small class="file_info text-muted"></small>

                    </div>
                </div>
                <div class="col-sm-8 col-md-8 bg-light p-2">
                    <div class="p-4 mx-auto shadow rounded">

                        <?php if (count($errors) > 0) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Errors:</strong>
                                <?php foreach ($errors as $error) : ?>
                                    <br><?= $error ?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <input class="form-control my-3" type="text" value="<?= get_var('first_name', $row->first_name); ?>" name="first_name" placeholder="Fisrt name" autofocus>
                        <input class="form-control my-3" type="text" value="<?= get_var('last_name', $row->last_name); ?>" name="last_name" placeholder="Last name" autofocus>
                        <input class="form-control my-3" type="email" value="<?= get_var('email', $row->email); ?>" name="email" placeholder="Email" autofocus>
                        <select class="my-3 form-control" name="gender">
                            <option <?= get_select('gender', $row->gender) ?> value="<?= $row->gender ?>"><?= ucwords($row->gender) ?></option>
                            <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                            <option <?= get_select('gender', 'female') ?> value="female">Female</option>
                        </select>
                        <select class="my-3 form-control" name="rank">
                            <option <?= get_select('rank', $row->rank) ?> value="<?= $row->rank ?>"><?= ucwords($row->rank) ?></option>
                            <option <?= get_select('rank', 'student') ?> value="student">Student</option>
                            <option <?= get_select('rank', 'reception') ?> value="reception">Reception</option>
                            <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                            <?php if (Auth::getRank() == 'super_admin') : ?>
                                <option <?= get_select('rank', 'super_admin') ?> value="super_admin">Super Admin</option>
                            <?php endif; ?>
                        </select>

                        <input class="form-control my-3" value="<?= get_var('password'); ?>" type="password" name="password" placeholder="Password" autofocus>
                        <input class="form-control my-3" value="<?= get_var('confirmPassword'); ?>" type="password" name="confirmPassword" placeholder="Confirm password" autofocus>

                        <button class="btn btn-success float-end" type="submit">Save Change</button>
                        <a href="<?= ROOT ?>/profile/<?= $row->url_address ?>">
                            <button type="button" class="btn btn-warning fload-end">Back to profile</button>
                        </a>
                    </div>
                </div>
        </form>




    <?php else : ?>
        <center>
            <h4>That profile doesn't exist</h4>
        </center>
    <?php endif; ?>

</div>

<script>
    function display_image_name(file_name) {
        document.querySelector(".file_info").innerHTML = '<br>Selected file:<br>' + file_name;
    }
</script>

<?php $this->view('includes/footer') ?>