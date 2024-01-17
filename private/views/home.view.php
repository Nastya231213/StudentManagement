<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>
<style>
    h1 {
        font-size: 80px;
        color: goldenrod;
    }

    .card-header {
        font-weight: bold;
        color: blue;
    }

    a {
        text-decoration: none;
    }
</style>
<div class="container-fluid p-4 m-4 shadow mx-auto" style="max-width:1000px">
    <div class="row justify-content-center ">
        <div class="col-3 shadow rounde-lg m-4 p-2 border ">
            <a href="<?=ROOT?>/schools">
                <div class="card-header">
                    SCHOOLS
                </div>
                <h1 class="text-center"><i class="fa fa-graduation-cap"></i></h1>
                <div class="card-footer">All schools</div>
            </a>
        </div>


        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/users">

                <div class="card-header">
                    STAFF
                </div>
                <h1 class="text-center"><i class="fa fa-chalkboard-teacher"></i></h1>
                <div class="card-footer">All staff members</div>
            </a>
        </div>
        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/classes">

                <div class="card-header">
                    CLASSES
                </div>
                <h1 class="text-center"><i class="fa fa-university"></i></h1>
                <div class="card-footer">All classes</div>
            </a>
        </div>
        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/students">

                <div class="card-header">
                    STUDENTS
                </div>
                <h1 class="text-center"><i class="fa fa-user-graduate"></i></h1>
                <div class="card-footer">All students</div>
            </a>
        </div>
        <div class="col-3 shadow rounde-lg m-4 p-2 border"><a href="<?=ROOT?>/profile">
                <div class="card-header">
                    TESTS
                </div>
                <h1 class="text-center"><i class="fa fa-file-signature"></i></h1>
                <div class="card-footer">All tests</div>
            </a>
        </div>

        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/profile">
                <div class="card-header">
                    PROFILE
                </div>
                <h1 class="text-center"><i class="fa fa-id-card"></i></h1>
                <div class="card-footer">All profiles</div>
            </a>
        </div>
        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/statistics">
                <div class="card-header">
                    STATISTICS
                </div>
                <h1 class="text-center"><i class="fa fa-chart-pie"></i></h1>
                <div class="card-footer">All tests</div>
            </a>
        </div>

        <div class="col-3 shadow rounde-lg m-4 p-2 border"> <a href="<?=ROOT?>/settings">
                <div class="card-header">
                    SETTINGS
                </div>
                <h1 class="text-center"><i class="fa fa-cogs"></i></h1>
                <div class="card-footer">App settings</div>
            </a>
        </div>

        <div class="col-3 shadow rounde-lg m-4 p-2 border">
            <a href="<?=ROOT?>/logout">
        <div class="card-header">
         
            <div class="card-header">
                LOGOUT
            </div>
            <h1 class="text-center"><i class="fa fa-sign-out-alt"></i></h1>
            <div class="card-footer">Logout from the system</div>
            </a>
        </div>
        
    </div>


</div>
s

<?php $this->view('includes/footer') ?>