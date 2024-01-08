<?php

class Signup extends Controller
{
    function index()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {
                $user = new User();
                $this->redirect('login');
            } else {
                //errors
                $errors = $user->errors;
            }
        }
        $this->view(
            'signup',
            ['errors' => $errors]

        );
    }
}
