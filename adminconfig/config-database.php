<?php
    function OpenCon(){
        $dbhost = "";
        $dbuser = "root";
        $dbpass = "";
        $db = "sportshop";

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

        return $conn;
    }
    
    function CloseCon($conn){
        $conn -> close();
    }
?>