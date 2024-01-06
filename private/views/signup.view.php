<?php $this->view('includes/header') ?>

<div class="container-fluid">
    <div class="p-4 mx-auto shadow rounded" style=" margin-top:50px;width:100%;max-width:310px">
        <h2 class="text-center">My School</h2>
        <div align="center">
            <img src="<?= ROOT ?>/assets/logo.png" class="border border-primary rounded-circle" style="width:100px">
        </div>

        <h3 class=="mb-2" align="center">Add User</h3>
        <input class="form-control my-3" type="firstname" name="firstname" placeholder="Fisrt name" autofocus>
        <input class="form-control my-3" type="email" name="lastname" placeholder="Last name" autofocus>
        <input class="form-control my-3" type="email" name="email" placeholder="Email" autofocus>
        <select class="my-3 form-control">
            <option>--Select a Gender--</option>
            <option>Male</option>
            <option>Female</option>
        </select>
        <select class="my-3 form-control">
            <option value="">--Select a Rank--</option>
            <option value="student">Student</option>
            <option value="reception">Reception</option>
            <option value="lecturer">Lecturer</option>
            <option value="super_admin">Super Admin</option>
        </select>
        <input class="form-control my-3" type="password" name="password" placeholder="Password" autofocus>
        <input class="form-control my-3" type="password" name="confirmPassword" placeholder="Confirm password" autofocus>

        <button class="btn btn-primary float-end">Add User</button>
        <button class="btn btn-warning fload-end">Cancel</button>

    </div>

</div>


<?php $this->view('includes/footer') ?>