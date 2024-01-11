<?php 

class Students extends Controller{

    function index()
    {
        $user=new User();
        $school_id=Auth::getSchool_id();
    
        $data=$user->query("select * from users where school_id =:school_id and rank in ('student')",[':school_id'=> $school_id]);
        $crumbs[]=['Dashboard',''];
        $crumbs[]=['Staff','users'];
        
        $this->view("students",['rows'=>$data,'crumbs'=>$crumbs,'mode'=>'students']);
        
    }
}