<?php $this->view('includes/header') ?>

<div class="container-fluid">
    <div class="p-4 mx-auto shadow rounded" style=" margin-top:50px;width:100%;max-width:310px">
        <h2 class="text-center">My School</h2>
        <div align="center">
            <img src="<?=ROOT?>/assets/logo.png" class="border border-primary rounded-circle" style="width:100px">
        </div>
        
        <h3 class=="mb-2" align="center">Login</h3>
        <input class="form-control" type="email" name="email" placeholder="Email" autofocus>
        <br>
        <input class="form-control" type="password" name="password" placeholder="Password" autofocus>
        <br>
        <button class="btn btn-primary">Login</button>
    </div>

</div>


<?php $this->view('includes/footer') ?>