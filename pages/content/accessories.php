<div class="text-center mb-3">
    <h1>Phụ kiện bóng đá</h1>
</div>

<?php
    require_once('./admincp/config-database.php');
    $conn = openCon();

    $query = "SELECT * FROM product WHERE type = 'accessories'";
    $result = $conn->query($query);

    $counter = $result->num_rows;
    $itemInPage = 9;
    $pageCounter = 1;
    if($counter % $itemInPage == 0){
        $pageCounter = $counter / $itemInPage;
    }
    else{
        $pageCounter =(int) ($counter / $itemInPage) + 1;
    }

    if($_GET['page']){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    //tính điểm bắt đầu
    $start = ($page - 1) * $itemInPage;

    $query1 = "SELECT * FROM product WHERE type = 'accessories' LIMIT $start, $itemInPage";
    $result1 = $conn->query($query1);

    if($result1->num_rows > 0){
        while($row = $result1->fetch_assoc()){
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

    echo
    "
    <nav aria-label='Page navigation example' class='float-end pt-3 d-flex justify-content-center'>
        <ul class='pagination'>
            <a class='page-link' href='?contentmenu=phukienbongda&page=".($page > 1 ? $page - 1 : $page)."''><li class='page-item disabled'>Previous</li></a>
    ";
    for($i = 1; $i <= $pageCounter; $i++){
        echo
        "
        <a class='page-link' href='?contentmenu=phukienbongda&page=".$i."'><li class='page-item disabled'>".$i."</li></a>
        ";
    }

    echo 
    "
    <a class='page-link' href='?contentmenu=phukienbongda&page=".($page < $pageCounter ? $page + 1 : $page)."''><li class='page-item disabled'>Next</li></a>
        </ul> 
    </nav>  
    ";
?>