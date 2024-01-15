<?php

class Students_model extends Model
{
    protected $table = "class_students";
    protected $allowedColumns = ['user_id', 'class_id', 'disabled', 'date', 'school_id'];
    protected  $beforeInsert  = [
        'make_school_id'
    ];
    protected $afterSelect = [
        'get_user'
    ];



    public function make_school_id($data)
    {
        if (isset($_SESSION['USER']->school_id)) {
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }
    public function get_user($data)
    {
        $user = new User();
        if (is_array($data)) {
            foreach ($data as $key => $row) {
                if (isset($row->user_id)) {
                    $result = $user->where('url_address', $row->user_id);
                    if (is_array($result)) {
                        $data[$key]->user = $result[0];
                    }
                }
            }
        }
        return $data;
    }
}
