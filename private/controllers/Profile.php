<?php

class Profile extends Controller
{
    function index($id = '')
    {
        $user = new User();
        $id = trim($id == '') ? Auth::getUser_id() : $id;

        $row = $user->whereOne('url_address', $id);
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Profile', 'profile'];
        if ($row) {
            $crumbs[] = [$row->first_name, 'profile'];
        }
        $data['page_tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'info';

        if ($data['page_tab'] == 'classes' && $row) {
            $class = new Classes_model();
            $lect = new Lecturers_model();

            $mytable = "class_students";
            if ($row->rank == "lecturer") {
                $mytable = "class_lecturers";
            }

            $query = "select * from $mytable where user_id=:user_id && disabled=0";
            $data['stud_classes'] = $lect->query($query, ['user_id' => $id]);
            $data['student_classes'] = array();

            if ($data['stud_classes']) {
                foreach ($data['stud_classes'] as $key => $arow) {
                    $data['student_classes'][] = $class->whereOne('class_id', $arow->class_id);
                }
            }
        }
        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        if (Auth::access('reception') || Auth::i_own_content($row)) {
            $this->view('profile', $data);
        } else {
            $this->view('access-denied');
        }
    }

    function edit($id = '')
    {
        $user = new User();
        $errors = array();
     
        $id = trim($id == '') ? Auth::getUser_id() : $id;
    
        $row = $user->whereOne('url_address', $id);
        if (count($_POST) > 0 && Auth::access('reception')) {
            if ($errors = $user->validate($_POST, $id)) {

                if(count($_FILES)>0){
                
                    $allowed[]="image/jpeg";
                    $allowed[]="image/png";
                    $allowed[]="image/jpg";

                    if($_FILES['image']['error'] ==0 && in_array($_FILES['image']['type'],$allowed)){
                        $folder = '../private/uploads/';
                        if(!file_exists($folder)){
                            mkdir($folder,0777,true);
                        }
                        $destination=$folder.$_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                        $_POST['image']=$_FILES['image']['name'];
                    }

                }


                $_POST['date'] = date("Y-m-d H:i:s");
                if ($_POST['rank'] == 'super_admin' && $_SESSION['USER']->rank != 'super_admin') {
                    $_POST['rank'] = 'admin';
                }
                if(empty($_POST['password'])){
                    unset($_POST['password']);
                }


                if (is_object($row)) {
                    $user->update($row->id, $_POST);
                }

                $redirect = 'profile/edit/' . $id;

                $this->redirect($redirect);
            } else {
                //errors
                $errors = $user->errors;
            }
        }
        $data['row'] = $row;
        $data['errors'] = $errors;
        if (Auth::access('reception') || Auth::i_own_content($row)) {
            $this->view('profile-edit', $data);
        } else {
            $this->view('access-denied');
        }
    }
}
