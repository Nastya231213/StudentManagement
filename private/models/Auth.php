


<?php
class Auth
{

    public static function authenticate($row)
    {

        $_SESSION['USER'] = $row;
    }

    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }
    public static function logged_in()
    {
        if (isset($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    public static function user()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->first_name;
        }
        return false;
    }
    public static function __callStatic($method, $params)
    {
        $prop = strtolower(str_replace("get", "", $method));

        if (isset($_SESSION['USER']->$prop)) {
            return $_SESSION['USER']->$prop;
        }

        return 'Unknown';
    }
    public static function getSchool_name()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->school_name;
        }
    }
    public static function getSchool_id()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->school_id;
        }
    }
    public static function getRank()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->rank;
        }
    }
    public static function getUser_id()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->url_address;
        }
    }

    public static function switch_school($id)
    {

        if (isset($_SESSION['USER']) && $_SESSION['USER']->rank = 'super_admin') {
            $user = new User();
            $school = new School();
            $row = $school->where('id', $id);
            if ($row) {
                $row = $row[0];
                $arr['school_id'] = $row->school_id;
                if ($user->update($_SESSION['USER']->id, $arr)) {
                    $_SESSION['USER']->school_id = $row->school_id;
                    $_SESSION['USER']->school_name = $row->school;
                }
            }
            return true;
        }
        return false;
    }

    public static function access($rank = 'student')
    {

        if (!isset($_SESSION['USER'])) {
            return false;
        }
        $logged_in_rank = $_SESSION['USER']->rank;
        $RANK['super_admin'] = ['super_admin', 'admin', 'lecturer', 'reception', 'student'];
        $RANK['admin'] = ['admin', 'lecturer', 'reception', 'student'];
        $RANK['lecturer'] = ['lecturer', 'reception', 'student'];
        $RANK['reception'] = ['reception', 'student'];
        $RANK['student'] = ['student'];

        if (!isset($RANK[$logged_in_rank])) {
            return false;
        }

        if (in_array($rank, $RANK[$logged_in_rank])) {
            return true;
        }

        return false;
    }public static function i_own_content($row){

        if(!isset($_SESSION['USER'])){
            return false;
        }
        if(isset($row->user_id)){

            if($_SESSION['USER']->url_address==$row->user_id){
                return true;
            }
        }
        $allowed[]='super_admin';
        $allowed[]='admin';
        if(in_array($_SESSION['USER']->rank,$allowed)){
            return true;
        }
        return false;
    }
}
