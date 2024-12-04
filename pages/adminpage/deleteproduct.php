<?php
    $id = $_GET['id'];
    
    require_once('../../admincp/config-database.php');
    $conn = openCon();
                
    $query = "DELETE FROM product WHERE id = '$id'";
    $result = $conn->query($query);

    if($conn->affected_rows > 0){
        echo 
        '
        <script>
            alert("Xóa sản phẩm thành công");
            window.location.href = "./adminpage.php";
        </script>
        ';
        exit();
    }
    else{
        echo 
        '
        <script>
            alert("Không tìm thấy sản phẩm hoặc có lỗi xảy ra");
            window.location.href = "./adminpage.php";
        </script>
        ';
        exit();
    }
    
?>