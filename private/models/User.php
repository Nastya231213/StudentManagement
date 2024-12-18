<?php

class User extends Model
{
      protected $table = "users";
      protected $beforeInsert = ['make_user_id', 'make_school_id', 'hash_password'];
      protected $allowedColumns = [
            'first_name',
            'last_name',
            'email',
            'password',
            'gender',
            'rank',
            'date',
            'image'
      ];

      protected $beforeUpdate=[
            'hash_password'
      ];


      public function validate($DATA, $id = '')
      {
            $this->errors = array();
            if (!preg_match('/^[a-zA-Z]*$/', $DATA['first_name']) || empty($DATA['first_name'])) {
                  $this->errors['first_name'] = "Letters can be in the first name";
            }
            if (!preg_match('/^[a-zA-Z]*$/', $DATA['last_name']) || empty($DATA['last_name'])) {
                  $this->errors['last_name'] = "Letters can be in the last name";
            }
            if (!($id!='' && empty($DATA['password']))) {
                  if ($DATA['password'] != $DATA['confirmPassword'] || empty($DATA['password'])) {
                        $this->errors['password'] = "The passwords aren't equal";
                  }
            }

            if (trim($id) == "") {
                  if (is_array($this->where('email', $DATA['email']))) {
                        $this->errors['email'] = "That email is already in";
                  }
            } else {
          
                  if (is_array($this->query("SELECT email FROM $this->table WHERE email = :email AND url_address != :id", ['email' => $DATA['email'], 'id' => $id]))) {
                        $this->errors['email'] = "That email is already in";
                  }
            }

            if (!filter_var($DATA['email'], FILTER_VALIDATE_EMAIL) || empty($DATA['email'])) {
                  $this->errors['email'] = "Email isn't appropriate";
            }

            $genders = ['female', 'male'];
            if (empty($DATA['gender']) || !in_array($DATA['gender'], $genders)) {
                  $this->errors['gender'] = "Gender isn't appropriate";
            }
            $ranks = ['student', 'reception', 'lecturer', 'super_admin'];
            if (empty($DATA['rank']) || !in_array($DATA['rank'], $ranks)) {
                  $this->errors['rank'] = "Rank isn't appropriate";
            }
            if (count($this->errors) == 0) {
                  return true;
            }

            return false;
      }

      public function make_user_id($data)
      {

            $data['url_address'] = strtolower($data['first_name'] . '.' . $data['last_name']);
            if (is_array($this->where('url_address', $data['url_address']))) {
                  $data['url_address'] .= rand(100, 9999);
            }

            return $data;
      }

      public function make_school_id($data)
      {
            if (isset($_SESSION['USER']->school_id)) {
                  $data['school_id'] = $_SESSION['USER']->school_id;
            }
            return $data;
      }
      public function hash_password($data)
      {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            return $data;
      }
}
