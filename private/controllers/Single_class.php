<?php

class Single_class extends Controller
{
    function index($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $lect = new Lecturers_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $results = false;

        //display
        if ($page_tab == 'lecturers') {
            $query = "select * from class_lecturers where class_id=:class_id && disabled = 0";
            $lecturers = $lect->query($query, ['class_id' => $id]);

            $data['lecturers'] = $lecturers;
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['results'] = $results;
        $data['page_tab'] = $page_tab;
        $data['row_user'] = $row_user;
        $data['errors'] = $errors;

        $this->view('single_class', $data);
    }

    function lectureradd($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $lect = new Lecturers_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $page_tab = 'lecturers-add';
        $results = array();
        if (count($_POST) > 0) {
            //add lecturer
            $query = "select * from users where (first_name like :fname || last_name like :lname) && rank ='lecturer' limit 10";

            if (isset($_POST['search'])) {

                if (!empty(trim($_POST['name']))) {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    $query = "select id from class_lecturers where user_id=:user_id && class_id=:class_id limit 1";
                    $check=$lect->query($query, ['user_id' => $_POST['selected'], 'class_id' => $id]);
                 
                    if (!$check) {
                        $arr = array();
                        $arr['class_id'] = $id;
                        $arr['disabled'] = 0;
                        $arr['user_id'] = $_POST['selected'];
                        $arr['date'] = date("Y-m-d H:i:s");
                        $lect->insert($arr);
                        $this->redirect('single_class/' . $id . '?tab=lecturers');
                    } else {
                        $errors[] = "the lecturer is in this class";
                    }
                }
            }
        }


        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['results'] = $results;
        $data['page_tab'] = $page_tab;
        $data['row_user'] = $row_user;
        $data['errors'] = $errors;

        $this->view('single_class', $data);
    }

    function lecturerremove($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $lect = new Lecturers_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $page_tab = 'lecturers-remove';
        $results = false;
        if (count($_POST) > 0) {
            //add lecturer
            $query = "select * from users where (first_name like :fname || last_name like :lname) && rank ='lecturer' limit 10";

            if (isset($_POST['search'])) {

                if (!empty(trim($_POST['name']))) {
                    $user = new User();
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $user->query($query, ['fname' => $name, 'lname' => $name]);
                } else {
                    $errors[] = "please type a name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    $query = "select id from class_lecturers where user_id=:user_id && class_id=:class_id limit 1";
                    if ($row = $lect->query($query, ['user_id' => $_POST['selected'], 'class_id' => $id])) {
                        $arr = array();
                        $arr['disabled'] = 1;
                        $lect->update($row[0]->id, $arr);
                        $this->redirect('single_class/' . $id . '?tab=lecturers');
                    } else {
                        $errors = "that lecturer wasn't found in this class";
                    }
                }
            }
        }


        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['results'] = $results;
        $data['page_tab'] = $page_tab;
        $data['row_user'] = $row_user;
        $data['errors'] = $errors;

        $this->view('single_class', $data);
    }
}
