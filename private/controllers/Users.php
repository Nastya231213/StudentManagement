<?php 

class Users extends Controller{

    function index()
    {
        $user=new User();
        $data=$user->findAll();
        $this->view("users",['rows'=>$data]);
        
    }
}