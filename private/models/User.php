<?php

class User extends Model{
      protected $table="users";
      protected $beforeInsert=['make_user_id','make_school_id','hash_password'];
      protected $allowedColumns=[
            'first_name',
            'last_name',
            'email',
            'password',
            'gender',
            'rank',
            'date'
      ];

      public function validate($DATA){
            $this->errors=array();
            if(!preg_match('/^[a-zA-Z]*$/',$DATA['first_name'])|| empty($DATA['first_name']) ){
                  $this->errors['first_name']="Letters can be in the first name";
            }
            if(!preg_match('/^[a-zA-Z]*$/',$DATA['last_name'])|| empty($DATA['last_name']) ){
                  $this->errors['last_name']="Letters can be in the last name";
            }
            if($DATA['password']!=$DATA['confirmPassword'] || empty($DATA['password'])){
                  $this->errors['password']="The passwords aren't equal";
            }

            if($this->where('email',$DATA['email'])){
                  $this->errors['email']="That email is already in";
            }
            if(!filter_var($DATA['email'],FILTER_VALIDATE_EMAIL) || empty($DATA['email'])){
                  $this->errors['email']="Email isn't appropriate";
            }

            $genders=['female','male'];
            if(empty($DATA['gender']) || !in_array($DATA['gender'],$genders)){
                  $this->errors['gender']="Gender isn't appropriate";
 
            }
            $ranks=['student','reception','lecturer','super_admin'];
            if(empty($DATA['rank']) || !in_array($DATA['rank'],$ranks)){
                  $this->errors['rank']="Rank isn't appropriate";
 
            }
            if(count($this->errors)==0){
                  return true;
            }

            return false;
      }
      private function random_string($length){
            $array=array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','f','g','h','j','k','l','q','w','e','r','t','y','u','i','o','p','z','x','c','v','b','n','m','A','B','C','D','F','G','H','J','K','L','Q','W','E','R','T','Y','U','I','O','P','Z','X','C','V','B','N','M');
            $text="";
            for($x=0;$x<$length;$x++){
                  $random=rand(0,61);
                  $text.=$array[$random];
            }
            return $text;

      }
      public function make_user_id($data){
            
            $data['url_address']= $this->random_string(60);
            return $data;
      }

      public function make_school_id($data){
            if(isset($_SESSION['USER']->school_id)){
                  $data['school_id']=$_SESSION['USER']->school_id;
            }
            return $data;
      }
      public function hash_password($data){
            $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
            return $data;
      }

     
}