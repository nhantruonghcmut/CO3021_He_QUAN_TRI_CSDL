<?php
require_once('./../../adminconfig/config-database.php');
$conn = openCon();


if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Bắt đầu giao dịch (transaction) để đảm bảo tính toàn vẹn dữ liệu
    $conn->begin_transaction();

    try {
        // Xóa các đơn hàng liên quan đến người dùng trước
        $delete_orders_query = "DELETE FROM orders WHERE userId = ?";
        $stmt = $conn->prepare($delete_orders_query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Xóa người dùng
        $delete_user_query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_user_query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Commit giao dịch
        $conn->commit();

        // Chuyển hướng về trang danh sách người dùng
        header("Location: admin.php?page=manageUser");
        exit();
    } catch (Exception $e) {
        // Rollback giao dịch nếu có lỗi
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>