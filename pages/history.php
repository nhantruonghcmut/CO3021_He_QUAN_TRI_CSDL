<?php
// session_start();
if (!$_SESSION || !($_SESSION["role"] == 2))
{
    echo '
        <script>
            window.location.href = "../index.php?headermenu=login";
        </script>
        ';
    exit();
}
else
{
    $id = $_SESSION["id"];
    require_once "./admincp/config-database.php";
    $conn = openCon();

    $query1 = "SELECT orderId FROM orders WHERE userId = '$id';";
    $orderlist = $conn->query($query1);

    echo '
        <div class="" style="background-color: #eee;">
                <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col mt-5 mb-5">
                        <p><span class="h2">Lịch sử giao dịch của bạn</span><span class="h4">(' . $orderlist->num_rows . ' orders)</span></p>
        ';

    if ($orderlist->num_rows > 0)
    {
        while ($row = $orderlist->fetch_assoc())
        {
            $query2 = "SELECT product.image, product.name, orders.quantity, orders.price_sell FROM orders JOIN product ON product.id = orders.productId WHERE orders.userId = '$id' && orders.orderId = '{$row["orderId"]}' ORDER BY orders.orderId ASC;";
            $orderdetail = $conn->query($query2);
            $sum_price = 0;
            echo '
                <b>Đơn số ' . $row["orderId"] . '</b> 
                <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá bán</th>
                                </tr>
                            </thead>
                            <tbody>';

            while ($record = $orderdetail->fetch_assoc())
            {
                $sum_price += $record["price_sell"] * $record["quantity"];
                echo '
                    <tr>
                        <th scope="row"><img src="' . $record["image"] . '" alt="..." style="height:40px; width: 40px;"></th>
                        <td>' . $record["name"] . '</td>
                        <td>' . $record["quantity"] . '</td>
                        <td>' . $record["price_sell"] * $record["quantity"] . ' VNĐ</td>
                    </tr>                          
                    ';
            }
            echo '</tbody>
                </table>
                            <b>Tổng tiền: '. $sum_price .' VNĐ</b>

            </div>
        </div>
    </div>';
        }
    }
}
?>