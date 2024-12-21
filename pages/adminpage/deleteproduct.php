<?php
$id = $_GET['id'];

require_once('./../../adminconfig/config-database.php');
$conn = openCon();
try {
    $conn->begin_transaction();
    $query = "DELETE FROM product WHERE id = '$id'";
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) {
        echo
            '
            <script>
            alert("Xóa sản phẩm thành công");
            window.location.href = "./../admin/admin.php?page=manageListProduct";
            </script>
            ';
        $conn->commit();
    } else {
        echo
            '
            <script>
                alert("Không tìm thấy sản phẩm hoặc có lỗi xảy ra");
            </script>
            ';
        $conn->rollback();
    }
} catch (Exception $exception) {
    //Rollback giao dịch nếu có lỗi
    $conn->rollback();
    echo "Transaction thất bại: " . $exception->getMessage() . "";
}
CloseCon($conn);
?>