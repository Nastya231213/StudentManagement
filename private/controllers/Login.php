<?php

class Login extends Controller
{
    function index()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();
            if ($row = $user->whereOne('email', $_POST['email'])) {

                if (password_verify($_POST['password'], $row->password)) {
                    $school=new School();
                    $school_row=$school->whereOne('school_id',$row->school_id);
                    $row->school_name=$school_row->school;
                    Auth::authenticate($row);
                    $this->redirect('/home');
                }
            }
            $errors['email'] = 'Wrong email or password';
        }

        $this->view('login', ['errors' => $errors]);
    }
}
