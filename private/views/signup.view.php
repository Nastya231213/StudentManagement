<?php $this->view('includes/header') ?>
<?php
print_r($errors);
?>


<div class="container-fluid">
    <form method="post">
        <div class="p-4 mx-auto shadow rounded" style=" margin-top:50px;width:100%;max-width:310px">
            <h2 class="text-center">My School</h2>
            <div align="center">
                <img src="<?= ASSETS ?>/logo.png" class="border border-primary rounded-circle" style="width:100px">
            </div>

            <h3 class="mb-2" align="center">Add User</h3>
            <?php if(count($errors)>0):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong> 
                <?php foreach($errors as $error):?>
                <br><?= $error?>
                <?php endforeach;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>
            <input class="form-control my-3" type="text" value="<?= get_var('firstname'); ?>" name="first_name" placeholder="Fisrt name" autofocus>
            <input class="form-control my-3" type="text" value="<?= get_var('lastname'); ?>" name="last_name" placeholder="Last name" autofocus>
            <input class="form-control my-3" type="email" value="<?= get_var('email'); ?>" name="email" placeholder="Email" autofocus>
            <select class="my-3 form-control" name="gender">
                <option <?= get_select('gender', '') ?>>--Select a Gender--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                <option <?= get_select('gender', 'female') ?> value="female">Female</option>
            </select>
            <select class="my-3 form-control" name="rank">
                <option <?= get_select('rank', '') ?> value="">--Select a Rank--</option>
                <option <?= get_select('rank', 'student') ?> value="student">Student</option>
                <option <?= get_select('rank', 'reception') ?> value="reception">Reception</option>
                <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                <option <?= get_select('rank', 'super_admin') ?> value="super_admin">Super Admin</option>
            </select>
            <input class="form-control my-3" value="<?= get_var('password'); ?>" type="password" name="password" placeholder="Password" autofocus>
            <input class="form-control my-3" value="<?= get_var('confirmPassword'); ?>" type="password" name="confirmPassword" placeholder="Confirm password" autofocus>

            <button class="btn btn-primary float-end" type="submit">Add User</button>
            <button type="submit" class="btn btn-warning fload-end">Cancel</button>

        </div>
    </form>
</div>


<?php $this->view('includes/footer') ?>