<?php
    // Lấy từ khóa tìm kiếm từ URL query string
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    if($keyword != ''){
        // Kết nối đến cơ sở dữ liệu và thực hiện truy vấn tìm kiếm
        require_once('./admincp/config-database.php');
        $conn = openCon();

        // Sử dụng filter để lọc dữ liệu
        $query = "SELECT * FROM product WHERE name LIKE '%$keyword%'";
        $result = $conn->query($query);

        // Kiểm tra và hiển thị kết quả
        if($result->num_rows > 0){
            echo
            "
            <div class='text-center mb-3'>
                <h1>Kết quả tìm kiếm</h1>
            </div>
            ";
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
        else{
            echo 'Không tìm thấy kết quả phù hợp.';
        }

        // Đóng kết nối với cơ sở dữ liệu
        $conn->close();
    }
    else{
        echo
        '<script>   
            window.location.href = "index.php";
        </script>';
        exit();
    }
?>