<?php 

class Users extends Controller{

    function index()
    {
        $user=new User();
        $school_id=Auth::getSchool_id();
    
        $data=$user->query("select * from users where school_id =:school_id and rank not in ('student','super_admin')",[':school_id'=> $school_id]);
        $crumbs[]=['Dashboard',''];
        $crumbs[]=['Staff','users'];
        $this->view("users",['rows'=>$data,'crumbs'=>$crumbs]);
        
    }
}