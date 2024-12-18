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
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Schools', 'schools'];
       
        if(Auth::access('super_admin')){
            $this->view('schools', [
                'rows' => $data,
                'crumbs' => $crumbs
            ]);
        }else{
            $this->view('access-denied');
        }
       
    }
    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors = array();
        if (count($_POST) > 0) {
            $school = new School();
            if ($school->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $school->insert($_POST);
                $this->redirect('schools');
            } else {
                $errors = $school->errors;
            }
        }
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Schools', 'schools'];
        $crumbs[] = ['Add', 'schools/add'];

        $this->view('schools.add', [
            'errors' => $errors,
            'crumbs' => $crumbs
        ]);
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $school = new School();

        $errors = array();
        if (count($_POST) > 0 && Auth::access('super_admin')) {
            if ($school->validate($_POST)) {
                $school->update($id, $_POST);
                $this->redirect('schools');
            } else {
                $errors = $school->errors;
            }
        }
        $row = $school->where('id', $id);
        if ($row) {
            $row = $row[0];
        }
        if (Auth::access('super_admin')) {
            $this->view('schools.edit', [
                'errors' => $errors,
                'row' => $row
            ]);
        }else{
            $this->view('access-denied');
        }
    }
    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $school = new School();

        $errors = array();
        if (count($_POST) > 0 &&  Auth::access('super_admin')) {
            $school->delete($id);
            $this->redirect('schools');
        }
        $row = $school->where('id', $id);
        if ($row) {
            $row = $row[0];
        }
        if( Auth::access('super_admin')){
            $this->view('schools.delete', [
                'errors' => $errors,
                'row' => $row
            ]);
        }else{
            $this->view('access-denied');

        }
     
    }
}
