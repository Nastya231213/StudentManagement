<?php


class Database
{

    private function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;
        if (!$con = new PDO($string, DBUSER, DBPASS)) {
            die("couldn't connect to database");
        }
        return $con;
    }

    public function query($query, $data = array(), $data_type = "object")
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $result=false;
        if ($stm) {
            $check = $stm->execute($data);
            if ($check) {
                if ($data_type == "object") {
                    $result= $stm->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }

        if (is_array($result)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $result = $this->$func($result);
                }
            }
        }
     

        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return false;
    }

 
}
