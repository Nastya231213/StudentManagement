<?php

class User extends Model{
      protected $table="users";

      public function validate($DATA){
            $this->errors=array();
            if(!preg_match('/^[a-zA-Z]*$/',$DATA['firstname'])){
                  $this->errors[]="Only letters allowed in first name";
            }
      
            if($DATA['password']!=$DATA['passwordConfirm']){
                  $this->errors[]="The passwords dont'match";
            }
            if(count($this->errors)==0){
                  return true;
            }

            return false;
      }

}