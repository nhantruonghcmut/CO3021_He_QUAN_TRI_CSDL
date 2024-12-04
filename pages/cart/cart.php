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

        $query = "SELECT (orderId,userId,productId,quantity) FROM orders INNER JOIN product ON orders.productId = product.id WHERE orders.userId = '$id';";
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
                                $sum_price += $row['number']*$row['price'];
                                echo
                                '  
                                            <tr>
                                                <th scope="row"><img src="'. $row["image"] .'" alt="..." style="height:40px; width: 40px;"></th>
                                                <td>'. $row["name"] .'</td>
                                                <td>'. $row["number"] .'</td>
                                                <td>'. $row["price"]*$row["number"] .' VNĐ</td>
                                                <td>
                                                    <a href="./pages/cart/deleteCartItem.php?id='. $row['orderId'] .'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </a>
                                                </td>
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
            
                        <div class="d-flex justify-content-end">
                            <a href="index.php"><button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg me-2">Tiếp tục mua</button></a>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Thanh toán</button>
                        </div>
            
                    </div>
                </div>
                </div>
            </div>
            ';
                
            
        }
    }
?>