<?php
    function OpenCon(){
        $dbhost = "";
        $dbuser = "root";
        $dbpass = "hai.hoang2309";
        $db = "sportshop";

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

        return $conn;
    }
    
    function CloseCon($conn){
        $conn -> close();
    }
?>