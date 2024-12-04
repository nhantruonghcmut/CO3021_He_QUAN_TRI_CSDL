<div class="text-center mb-3">
    <h1>Chi tiết sản phẩm</h1>
</div>

<?php
    require_once('./admincp/config-database.php');
    $conn = openCon();

    $id = $_GET["detailproduct"];

    $query = "SELECT * FROM product WHERE id = ". $id .";";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    echo 
    "
    <div class='row'>
        <div class='col-lg-6'>
            <div>
                <img src='" . $data['image'] . "' alt='...' style='width:400px;height:400px'>
            </div>
            <div class='row'>
                <div class='col-4'>
                    <img src='" . $data['image'] . "' alt='...' class='img-thumbnail mt-2'>
                </div>
                <div class='col-4'>
                    <img src='" . $data['image'] . "' alt='...' class='img-thumbnail mt-2'>
                </div>
                <div class='col-4'>
                    <img src='" . $data['image'] . "' alt='...' class='img-thumbnail mt-2'>
                </div>
            </div>
        </div>
        <div class='col-lg-6'>
            <h3>" . $data['name'] . "</h3>
            <h4 class='text-primary'> Giá " . number_format($data["price"], 0, ',', '.') . " VNĐ</h4>
            <p>Số lượng hiện có: " . $data['quantity'] . "</p>
            <h5>Mô tả</h5>
            <p>" . $data['description'] . "</p>
            <p>BK SHOP</p>
            <p>Liên tục trả hàng anh em <br/>
            - Mẫu gì cũng có - In ấn chuẩn mực - Trả hàng chuẩn hẹn - Giá cả yêu thương - Rất nhiều khuyến mãi</p>
            <p>#BKShop<br/>
            - Nhận làm quần áo bóng đá, đồng phục, áo team đội !<br/>
            - Nhận may theo yêu cầu quần áo bóng...
            </p>
            <a href='./pages/cart/addCartController.php?id=". $data['id'] ."' class='btn btn-primary'>Mua ngay</a>
        </div>
    </div>
    ";
?>