<?php

class Students extends Controller
{

    function index()
    {
        $user = new User();
        $school_id = Auth::getSchool_id();
        $query = "select * from users where school_id =:school_id and rank in ('student') order by id desc";
        $arr[':school_id'] = $school_id;
        if(isset($_GET['find'])){
            $find='%'.$_GET['find'].'%';
            $query = "select * from users where school_id =:school_id and rank in ('student') && (first_name like :find || last_name like :find) order by id desc";
            $arr['find']=$find;
        }
        $data = $user->query($query, $arr);
        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Staff', 'users'];
        if (Auth::access('reception')) {
            $this->view("students", ['rows' => $data, 'crumbs' => $crumbs, 'mode' => 'students']);
        } else {
            $this->view('access-denied');
        }
    }
}
