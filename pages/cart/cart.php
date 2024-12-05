<?php
    // session_start();
    if(!($_SESSION) || !($_SESSION['role'] == 2)){ 
        echo 
        '
        <script>
            window.location.href = "../index.php?headermenu=login";
        </script>
        ';
        exit();
    }
    else{
        $id = $_SESSION['id'];
        require_once('./admincp/config-database.php');
        $conn = openCon();

        $query = "SELECT * FROM (SELECT * FROM cart_temp WHERE cart_temp.userId = '$id') AS temp_cart INNER JOIN (SELECT id,name,type,price,description,image FROM product) AS product ON temp_cart.productId = product.id;";
        $result = $conn->query($query);
        $sum_price = 0;
        echo
        '
        <div class="" style="background-color: #eee;">
                <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col mt-5 mb-5">
                        <p><span class="h2">Giỏ hàng của bạn</span><span class="h4">('. $result->num_rows .' sản phẩm)</span></p>
        ';

        if($result->num_rows > 0){
            echo 
            '
                        <div class="card mb-4">
                            <div class="card-body p-4">
                            <div class="row align-items-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
            ';
                            while($row = $result->fetch_assoc()){ 
                                $sum_price += $row['quantity']*$row['price'];
                                echo
                                '  
                                            <tr>
                                                <th scope="row"><img src="'. $row["image"] .'" alt="..." style="height:40px; width: 40px;"></th>
                                                <td>'. $row["name"] .'</td>
                                                <td>'. $row["quantity"] .'</td>
                                                <td>'. $row["price"]*$row["quantity"] .' VNĐ</td>
                                            </tr>                                        
                                ';
                            };
            echo
                    '                   </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            
                        <div class="card mb-5">
                            <div class="card-body p-4">
                                <div class="float-end">
                                    <p class="mb-0 me-5 d-flex align-items-center">
                                    <span class="small text-muted me-2">Tổng cộng:</span> <span
                                        class="lead fw-normal">'. $sum_price .' VNĐ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
            
                        <form method="post" action="">
                            <div class="d-flex justify-content-end">
                                <a href="index.php"><button type="button" class="btn btn-light btn-lg me-2">Tiếp tục mua</button></a>
                                <button type="submit" name="checkout" class="btn btn-primary btn-lg">Thanh toán</button>
                            </div>
                        </form>

            
                    </div>
                </div>
                </div>
            </div>
            ';
                
            
        }
    }
?>