<?php





class Tests extends Controller{
    public function index(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $tests = new Tests_model();
        $school_id = Auth::getSchool_id();
        if (Auth::access('admin')) {
            $query="select * from tests where school_id =:school_id order by id desc";
            $arr['school_id']=$school_id;
            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select * from tests where school_id =:school_id  && (test like :find) order by id desc";
                $arr['find'] = $find;
            }
            $data = $tests->query($query, $arr);

        } else {
            $myRank = Auth::getRank();
            $lect = new Lecturers_model();

            $mytable = "test_students";
            if ($myRank == "lecturer") {
                $mytable = "test_lecturers";
            }
            $query="select * from $mytable where user_id =:user_id && disabled=0";

            $arr['user_id']=Auth::getUser_id();

            if (isset($_GET['find'])) {
                $find = '%' . $_GET['find'] . '%';
                $query = "select tests.test,{$mytable}.* from $mytable join tests on tests.test_id={$mytable}.test_id where {$mytable}.user_id=:user_id && disabled=0 && tests.test like :find";
                $arr['find'] = $find;
            }
            
            $arr['stud_tests'] = $lect->query($query, $arr);
            $data = array();

            if ($arr['stud_tests']) {
                foreach ($arr['stud_tests'] as $key => $arow) {
                    $data[] = $tests->whereOne('test_id', $arow->test_id);
                }
            }
        }
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['tests', 'tests'];

        $this->view('tests', [
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
            $tests = new Tests_model();
            if ($tests->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $tests->insert($_POST);
                $this->redirect('tests');
            } else {
                $errors = $tests->errors;
            }
        }
        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['tests', 'tests'];
        $crumbs[] = ['Add', 'tests/add'];
        if (Auth::access('lecturer')) {

            $this->view('tests.add', [
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
        $tests = new Tests_model();

        $errors = array();
        $row = $tests->where('id', $id);
        if ($row) {
            $row = $row[0];
        }

        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row)) {
            if ($tests->validate($_POST)) {
                $tests->update($id, $_POST);
                $this->redirect('tests');
            } else {
                $errors = $tests->errors;
            }
        }

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {

            $this->view('tests.edit', [
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
        $tests = new Tests_model();
        $errors = array();
        $row = $tests->where('id', $id);
        if ($row) {
            $row = $row[0];
        }
        if (Auth::access('lecturer') && count($_POST) > 0 && Auth::i_own_content($row)) {

            $tests->delete($id);
            $this->redirect('tests');
        }

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {
            $this->view('tests.delete', [
                'errors' => $errors,
                'row' => $row
            ]);
        } else {
            $this->view('access-denied');
        }
    }

}