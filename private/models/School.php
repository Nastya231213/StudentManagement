<?php

class School extends Model
{
    protected $table = "schools";
    protected $allowedColumns = ['school', 'date'];
    protected  $beforeInsert  = [
        'make_school_id',
        'make_url_address'
    ];
    protected $afterSelect = [
        'get_user'
    ];
    public function validate($DATA)
    {
        $this->errors = array();
        if (!preg_match('/^[a-zA-Z]*$/', $DATA['school']) || empty($DATA['school'])) {
            $this->errors['school'] = "Only etters can be in the school name";
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

    public function make_school_id($data)
    {
        $data['school_id'] =  random_string(60);
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
