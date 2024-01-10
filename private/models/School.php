<?php

class School extends Model
{
    protected $table = "users";
    protected $beforeInsert = ['school','date'];
    protected $allowedColumns = [
        'make_school_id',
        'make_user_id'
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

    public function make_user_id($data)
    {

        $data['url_address'] = random_string(60);
        return $data;
    }

    public function make_school_id($data)
    {
        $data['school_id'] =  random_string(60);
        return $data;
    }
}
