
<style>
    nav ul li a{
       
        width:110px;
        text-align:center;

    }
    nav ul li :hover{
        background-color: grey;
        color:white!important;
    }
    


</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="<?=ASSETS?>/logo.png" class="border border-primary rounded-circle" style="width:60px">
            My School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=ROOT?>">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/classes">CLASSES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=ROOT?>/test">TESTS</a>
                </li>
            </ul>
                <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdow dropdown-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       USER
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=ROOT?>/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>