<?php

class Profile extends Controller{
    function index($id=''){
        $user=new User();
        $row=$user->whereOne('url_address',$id);
        $crumbs[]=['Dashboard','/'];
        $crumbs[]=['Profile','profile'];
        if($row){
            $crumbs[]=[$row->first_name,'profile'];
        }
        $this->view('profile',['row'=>$row,'crumbs'=>$crumbs]);

    }
}