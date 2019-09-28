<?php


require_once "db.inc";

class Transaction extends Database
{    
    function __construct()
    {
        $this->Open();
    }
    
    function StartTransaction(){
        mysqli_query("BEGIN");
    }
    
    function Commit(){
        mysqli_query("COMMIT");
    }
    
    function Rollback(){
        mysqli_query("ROLLBACK");
    }
    
}

?>