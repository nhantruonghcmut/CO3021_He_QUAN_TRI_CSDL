

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if(!($_SESSION) || !($_SESSION['role'] == 2)){ 
            echo 
            '
            <script>
                window.location.href = "../../index.php?headermenu=login";
            </script>
            ';
            exit();
        }
    ?>

    <?php
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            if ($_POST["submit"] == "Thêm vào giỏ hàng") {
                $productId = $_GET['id'];
                $userId = $_SESSION['id'];
                $number = $_POST["number"];

                if($number > 0){
                    require_once('../../admincp/config-database.php');
                    $conn = openCon();
                    $query = "INSERT INTO orders (userId, productId, number) VALUES ('$userId', '$productId', '$number')";
                    $result = $conn->query($query);

                    if ($result) {
                        echo 
                        '
                        <script>
                            alert("Thêm sản phẩm vào giỏ hàng thành công");
                            window.location.href = "../../index.php?headermenu=cart";
                        </script>
                        ';
                        exit();
                    } else {
                        echo 
                        '
                        <script>
                            alert("Có lỗi xảy ra");
                            window.location.href = "../../index.php?headermenu=cart";
                        </script>
                        ';
                        exit();
                    }
                }

                
            }
            else if ($_POST["submit"] == "Về trang chủ") {
                echo
                '
                <script>
                    window.location.href = "../../index.php";
                </script>
                ';
            }
        }
    ?>

    <div class="container bg-light mt-5 mb-5" style="width: 600px">
        <div class="row">
            <h2 class="fw-bold text-center mt-2">Thêm vào giỏ hàng</h2>
        </div>

        <?php 
            $id = $_GET['id']; 
            require_once('../../admincp/config-database.php');
            $conn = openCon();
            $query = "SELECT * FROM product WHERE id = '$id'";
            $result = $conn->query($query);
            $data = $result->fetch_assoc();
        ?>

        <form method="post" action="">
            <p>ID</p>
            <input disabled type="text" class="form-control mb-3" name="id" placeholder="ID" value="<?php echo $data['id']; ?>">
            <p>Tên sản phẩm</p>
            <input disabled type="text" class="form-control mb-3" name="name" placeholder="Name" value="<?php echo $data['name']; ?>">
            <p>Mô tả</p>
            <input disabled type="text" class="form-control mb-3" name="description" placeholder="Description" value="<?php echo $data['description']; ?>">
            <p>Số lượng</p>
            <input type="number" class="form-control mb-3" name="number" placeholder="Number" value="" min="1" max="<?php echo $data['quantity']; ?>">
            <p>Tổng giá</p>
            <input disabled id=price type="text" class="form-control mb-3" name="price" placeholder="Price" value="">

            <div class="row">
            <div class="col">
                    <input type="submit" class="form-control btn btn-outline-danger mt-3 mb-3" name="submit" value="Về trang chủ">
                </div>
                <div class="col">
                    <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Thêm vào giỏ hàng">
                </div>
            </div>
        </form>

    </div>   

    <script>
        // Lấy các trường input và sự kiện onchange
        const quantityInput = document.querySelector('input[name="number"]');
        const priceInput = document.getElementById('price');

        quantityInput.addEventListener('change', function() {
            // Lấy giá trị của trường số lượng
            const quantityValue = parseInt(quantityInput.value, 10);

            // Kiểm tra nếu giá trị hợp lệ
            if (!isNaN(quantityValue)) {
                // Tính giá trị tổng
                const totalPriceValue = <?php echo $data['price']; ?> * quantityValue;

                // Gán giá trị tổng vào trường input
                priceInput.value = totalPriceValue;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>