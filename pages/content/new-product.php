<div class="text-center mb-3">
    <h1>Sản phẩm mới</h1>
</div>

<?php
    require_once('./admincp/config-database.php');
    $conn = openCon();

    $query = "SELECT * FROM product ORDER BY id DESC LIMIT 9";
    $result = $conn->query($query);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo
            "
            <div class='col-lg-4 col-md-6 mb-2'>
                <a href='index.php?detailproduct=" . $row["id"] . "' class='text-decoration-none'>
                    <div class='card' style='width: 100%; height: auto;'>
                        <img src='" . $row["image"] . "' class='card-img-top' alt='...' style='width: 100%; height: 270px;'>
                        <div class='card-body'>
                            <div style='height: 60px;'><h5 class='card-title'>" . $row["name"] . "</h5></div>
                            <p class='card-text'>Số lượng hiện có: " . $row["quantity"] . "</p>
                            <p class='card-text mb-2'> Giá " . number_format($row["price"], 0, ',', '.') . " VNĐ</p>
                            <a href='./pages/cart/addCartController.php?id=". $row['id'] ."' class='btn btn-outline-primary text-decoration-none'>Mua ngay</a>
                        </div>
                    </div>
                </a>
            </div>
            ";
        }
    }
?>

                