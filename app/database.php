<?php
// database connection settings

class Database
{

    public function sqli(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'accounts';

        $mysqli = new mysqli($host, $user, $pass , $db) or die($myqli->error);
        return $mysqli;
    }

    // public function sqli($query){
    //     $this->$host = 'localhost';
    //     $this->$user = 'root';
    //     $this->$pass = '';
    //     $this->$db = 'accounts';

    //     $this->$mysqli = new mysqli($host, $user, $pass , $db) or die($myqli->error);
    //     return $this->$mysqli;
    // }

}
?>