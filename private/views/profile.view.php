<?php $this->view('includes/header') ?>
<?php $this->view('includes/navigation') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <?php $this->view('includes/crumbs'); ?>
    <div class="row">
        <div class="col-sm-3 col-md-4">
            <img src="<?=ASSETS?>/user_male.png" class="d-block border border-dark mx-auto rounded-circle" style="width:100px;">
        </div>
        <div class="col-sm-9 col-md-8 bg-light p-2">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Fisrt Name:</th>
                    <td>Nastya</td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td>Pashko</td>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <td>Female</td>
                </tr>
                <tr>
                    <th>Date Created:</th>
                    <td>2021-08-02</td>
                </tr>

            </table>

        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Basic Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Test</a>
            </li>
        </ul>
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"> </i></span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                </div>

            </form>

        </nav>

    </div>

</div>


<?php $this->view('includes/footer') ?>