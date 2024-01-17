<?php
class Classes extends Controller
{

    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new Classes_model();
        $school_id = Auth::getSchool_id();
        if (Auth::access('admin')) {
            $query="select * from classes where school_id =:school_id order by id desc";
            $arr['school_id']=$school_id;
            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select * from classes where school_id =:school_id  && (class like :find) order by id desc";
                $arr['find'] = $find;
            }
            $data = $classes->query($query, $arr);

        } else {
            $myRank = Auth::getRank();
            $class = new Classes_model();
            $lect = new Lecturers_model();

            $mytable = "class_students";
            if ($myRank == "lecturer") {
                $mytable = "class_lecturers";
            }
            $query="select * from $mytable where user_id =:user_id && disabled=0";

            $arr['user_id']=Auth::getUser_id();

            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select classes.class,{$mytable}.* from $mytable join classes on classes.class_id={$mytable}.class_id where {$mytable}.user_id=:user_id && disabled=0 && classes.class like :find";
                $arr['find'] = $find;
            }
            
            $arr['stud_classes'] = $lect->query($query, $arr);
            $data = array();

            if ($arr['stud_classes']) {
                foreach ($arr['stud_classes'] as $key => $arow) {
                    $data[] = $class->whereOne('class_id', $arow->class_id);
                }
            }
        }
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Classes', 'classes'];

        $this->view('classes', [
            'rows' => $data,
            'crumbs' => $crumbs,

        ]);
    }

    public function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }



        if (count($_POST) > 0 && Auth::access('lecturer')) {
            $classes = new Classes_model();
            if ($classes->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $classes->insert($_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['classes', 'classes'];
        $crumbs[] = ['Add', 'classes/add'];
        if (Auth::access('lecturer')) {

            $this->view('classes.add', [
                'errors' => $errors,
                'crumbs' => $crumbs
            ]);
        } else {
            $this->view('access-denied');
        }
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new Classes_model();

        $errors = array();
        $row = $classes->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row)) {
            if ($classes->validate($_POST)) {
                $classes->update($id, $_POST);
                $this->redirect('classes');
            } else {
                $errors = $classes->errors;
            }
        }

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {

            $this->view('classes.edit', [
                'errors' => $errors,
                'row' => $row
            ]);
        } else {
            $this->view('access-denied');
        }
    }
    public function delete($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $classes = new Classes_model();
        $errors = array();
        $row = $classes->where('id', $id);
        if ($row) {
            $row = $row[0];
        }
        if (Auth::access('lecturer') && count($_POST) > 0 && Auth::i_own_content($row)) {

            $classes->delete($id);
            $this->redirect('classes');
        }

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {
            $this->view('classes.delete', [
                'errors' => $errors,
                'row' => $row
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
