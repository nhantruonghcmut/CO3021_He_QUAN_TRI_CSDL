<p >cccc</p>
<?php
    session_start();
    if(!($_SESSION) || !($_SESSION['role'] == 2)){ 
        echo 
        '
        <script>
            window.location.href = "../../index.php?headermenu=login.php";
        </script>
        ';
        exit();
    }
    else{
        $id = $_SESSION['id'];
        require_once('../../admincp/config-database.php');
        $conn = openCon();

        $id = $_GET['id'];
    
        $query = "DELETE FROM orders WHERE orderID = '$id'";
        $result = $conn->query($query);

        if($conn->affected_rows > 0){
            echo 
            '
            <script>
                window.location.href = "./cartController.php";
            </script>
            ';
            exit();
        }
        else{
            echo 
            '
            <script>
                alert("Không tìm thấy sản phẩm hoặc có lỗi xảy ra");
                window.location.href = "./cartController.php";
            </script>
            ';
            exit();
        }
    }
?>