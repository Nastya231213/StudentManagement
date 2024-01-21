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

        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $results = false;

        //display
        if ($page_tab == 'lecturers') {
            $query = "select * from class_lecturers where class_id=:class_id && disabled = 0 order by id desc limit $limit offset $offset";
            $lecturers = $lect->query($query, ['class_id' => $id]);

            $data['lecturers'] = $lecturers;
        } else if ($page_tab == 'students') {
            $query = "select * from class_students where class_id=:class_id && disabled = 0 order by id desc limit $limit offset $offset";
            $students = $lect->query($query, ['class_id' => $id]);

            $data['students'] = $students;
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
                    $query = "select id, disabled from class_lecturers where user_id=:user_id && class_id=:class_id limit 1";
                    $check = $lect->query($query, ['user_id' => $_POST['selected'], 'class_id' => $id]);

                    if (!$check) {
                        $arr = array();
                        $arr['class_id'] = $id;
                        $arr['disabled'] = 0;
                        $arr['user_id'] = $_POST['selected'];
                        $arr['date'] = date("Y-m-d H:i:s");
                        $lect->insert($arr);
                        $this->redirect('single_class/' . $id . '?tab=lecturers');
                    } else {

                        if (isset($check[0]->disabled) && $check[0]->disabled) {
                            $arr = array();
                            $arr['disabled'] = 0;
                            $lect->update($check[0]->id, $arr);
                            $this->redirect('single_class/' . $id . '?tab=lecturers');
                        } else {
                            $errors[] = "the lecturer is in this class";
                        }
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
    function studentadd($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $student = new Students_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $page_tab = 'students-add';
        $results = array();
        if (count($_POST) > 0) {
            //add lecturer
            $query = "select * from users where (first_name like :fname || last_name like :lname) && rank ='student' limit 10";

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
                    $query = "select id from class_students where user_id=:user_id && class_id=:class_id && disabled=0 limit 1";
                    $check = $student->query($query, ['user_id' => $_POST['selected'], 'class_id' => $id]);

                    if (!$check) {
                        $arr = array();
                        $arr['class_id'] = $id;
                        $arr['disabled'] = 0;
                        $arr['user_id'] = $_POST['selected'];
                        $arr['date'] = date("Y-m-d H:i:s");
                        $student->insert($arr);
                        $this->redirect('single_class/' . $id . '?tab=students');
                    } else {
                        if (isset($check[0]->disabled) && $check[0]->disabled) {
                            $arr = array();
                            $arr['disabled'] = 0;
                            $student->update($check[0]->id, $arr);
                            $this->redirect('single_class/' . $id . '?tab=lecturers');
                        } else {
                            $errors[] = "the student is in this class";
                        }
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
    function studentremove($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $student = new Students_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $page_tab = 'students-remove';
        $results = false;
        if (count($_POST) > 0) {
            //add lecturer
            $query = "select * from users where (first_name like :fname || last_name like :lname) && rank ='student' limit 10";

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
                    $query = "select id from class_students where user_id=:user_id && class_id=:class_id  limit 1";
                    if ($row = $student->query($query, ['user_id' => $_POST['selected'], 'class_id' => $id])) {
                        $arr = array();
                        $arr['disabled'] = 1;
                        $student->update($row[0]->id, $arr);
                        $this->redirect('single_class/' . $id . '?tab=students');
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

    function testadd($id = '')
    {
        $user = new User();
        $classes = new Classes_model();
        $test = new Tests_model();
        $errors = array();

        $row = $classes->whereOne('class_id', $id);
        $page_tab = 'test-add';

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Tests', 'testsclasse'];
        if ($row) {
            $crumbs[] = [$row->class, ''];
            $row_user = $user->whereOne('url_address', $row->url_address);
        }
        $results = array();
        if (count($_POST) > 0) {
            //add lecturer
            $arr = array();
            $arr['class_id'] = $id;
            $arr['disabled'] = 0;
            $arr['description']=$_POST['description'];
            $arr['test']=$_POST['test'];
            $arr['date'] = date("Y-m-d H:i:s");
            $test->insert($arr);
            $this->redirect('single_class/' . $id . '?tab=tests');
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
