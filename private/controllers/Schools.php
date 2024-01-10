<?php

class Schools extends Controller
{

    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $school = new School();

        $data = $school->findAll();
        $this->view('schools', [
            'rows' => $data
        ]);
    }
    public function add(){
        if(!Auth::logged_in()){
            $this->redirect('login');
            
        }
        $errors=array();
        $school=new School();
        $this->view('schools', [
            'errors'=>$errors
        ]);
    }
}
