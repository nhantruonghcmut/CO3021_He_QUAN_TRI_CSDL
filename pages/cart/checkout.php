<?php
// Xử lý khi nhấn nút "Thanh Toán"
if (isset($_POST['checkout'])) {
    require_once('./admincp/config-database.php');
    $conn = openCon();

    $userId = $_SESSION['id']; // Lấy ID người dùng từ session

    // Lấy dữ liệu từ giỏ hàng
    $query_cart = "SELECT * FROM cart_temp WHERE userId = '$userId'";
    $result_cart = $conn->query($query_cart);

    if ($result_cart->num_rows > 0) {
        // Chuẩn bị chèn dữ liệu vào bảng orders
        $insert_orders = "INSERT INTO orders (orderId, userId, productId, orderdate, price_sell, quantity) VALUES ";

        $orderId = time(); // Sử dụng timestamp làm orderId (có thể tùy chỉnh)
        $values = [];

        while ($row = $result_cart->fetch_assoc()) {
            $productId = $row['productId'];
            $quantity = $row['quantity'];

            // Lấy thông tin giá bán từ bảng product
            $query_product = "SELECT price FROM product WHERE id = '$productId'";
            $result_product = $conn->query($query_product);
            $product = $result_product->fetch_assoc();
            $price_sell = $product['price'];

            // Lưu giá trị để chèn vào bảng orders
            $values[] = "('$orderId', '$userId', '$productId', NOW(), '$price_sell', '$quantity')";
        }

        // Thực hiện chèn dữ liệu vào bảng orders
        if (!empty($values)) {
            $insert_orders .= implode(", ", $values);
            if ($conn->query($insert_orders)) {
                // Xóa dữ liệu trong giỏ hàng sau khi thanh toán thành công
                $delete_cart = "DELETE FROM cart_temp WHERE userId = '$userId'";
                $conn->query($delete_cart);

                echo "<script>alert('Thanh toán thành công!'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra trong quá trình thanh toán.');</script>";
            }
        }
    } else {
        echo "<script>alert('Giỏ hàng của bạn đang trống.');</script>";
    }

    $conn->close();
}
?>
