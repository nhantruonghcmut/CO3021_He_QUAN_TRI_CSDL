<?php
    session_start();
    if(!($_SESSION) || !($_SESSION['role'] == 2)){ 
        echo 
        '
        <script>
            window.location.href = "../../index.php?headermenu=login";
        </script>
        ';
        exit();
    }
    else{
        echo 
        '
        <script>
            window.location.href = "../../index.php?headermenu=cart";
        </script>
        ';
        exit();
    }
?>