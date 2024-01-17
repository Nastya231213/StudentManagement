<?php

class Signup extends Controller
{
    function index()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {
                
                $_POST['date']=date("Y-m-d H:i:s");
                if(Auth::access('admin')){
                    if($_POST['rank']=='super_admin' && $_SESSION['USER']->rank!='super_admin'){
                        $_POST['rank']='admin';
                    }

                    $user->insert($_POST);

                }
                $this->redirect('users');
            } else {
                //errors
                $errors = $user->errors;
            }
        }
        $all_modes=['users','students'];
        $mode=isset($_GET['mode'])?$_GET['mode']:'';
        if(Auth::access('reception')){
            $this->view(
                'signup',
                ['errors' => $errors,'mode'=>$mode]
    
            );
        }else{
            $this->view('access-denied');
        }
      
    } 
}
