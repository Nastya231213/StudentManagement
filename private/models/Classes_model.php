<?php

class Classes_model extends Model
{
    protected $table = "classes";
    protected $allowedColumns = ['class', 'date'];
    protected  $beforeInsert  = [
        'make_class_id',
        'make_url_address',
        'make_school_id'
         
    ];
    protected $afterSelect = [
        'get_user'
    ];
    public function validate($DATA)
    {
        $this->errors = array();
        if (!preg_match('/^[a-zA-Z0-9 ]+$/', $DATA['class']) || empty($DATA['class'])) {
            $this->errors['class'] = "Only letters and numbers can be in the class name";
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function make_url_address($data)
    {

        if(isset($_SESSION['USER']->url_address)){
            $data['url_address'] = $_SESSION['USER']->url_address;
        }
        return $data;
    }

    public function make_class_id($data)
    {
        $data['class_id'] =  random_string(60);
        return $data;
    }
    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }
    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row) {
            $result = $user->where('url_address', $row->url_address);
            $data[$key]->user = $result[0];
        }

        return $data;
    }
}
