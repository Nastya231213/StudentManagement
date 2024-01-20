<?php

class Users extends Controller
{

    function index()
    {
        $user = new User();
        $school_id = Auth::getSchool_id();


        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $query = "select * from users where school_id =:school_id and rank not in ('student','super_admin') order by id desc limit $limit offset $offset";
        $arr['school_id'] = $school_id;


        if (isset($_GET['find'])) {
            $find = '%' . $_GET['find'] . '%';
            $query = "select * from users where school_id =:school_id and rank not in ('student','super_admin') && (first_name like :find || last_name like :find) order by id desc limit $limit offset $offset";
            $arr['find'] = $find;
        }
        $data = $user->query($query, $arr);

        $crumbs[] = ['Dashboard', ''];
        $crumbs[] = ['Staff', 'users'];

        if (Auth::access('admin')) {
            $this->view("users", ['rows' => $data, 'crumbs' => $crumbs,'pager'=>$pager]);
        } else {
            $this->view('access-denied');
        }
    }
}
