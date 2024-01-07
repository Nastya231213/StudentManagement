<?php 

class Home extends Controller{

    function index()
    {

        $user=new User();
        
        $data=$user->findAll();
        //$data=$user->where('first_name','alina');
        $this->view("home",['rows'=>$data]);
        
    }
}