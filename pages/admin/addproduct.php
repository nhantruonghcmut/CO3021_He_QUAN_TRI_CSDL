<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add Product Form</title>
</head>
<body>
    <?php
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            if ($_POST["submit"] == "Submit") {
                $name = $_POST["name"];
                $type = $_POST["type"];
                $quantity = $_POST["quantity"];
                $description = $_POST["description"];
                $image = $_POST["image"];
                $price = $_POST["price"];

                require_once('../../admincp/config-database.php');
                $conn = openCon();
                $query = "INSERT INTO product (name, type, price, quantity, description, image) VALUES ('$name', '$type', '$price', '$quantity', '$description', '$image')";
                $result = $conn->query($query);

                if ($result) {
                    echo 
                    '
                    <script>
                        alert("Thêm sản phẩm thành công");
                        window.location.href = "./adminpage.php";
                    </script>
                    ';
                    exit();
                } else {
                    echo 
                    '
                    <script>
                        alert("Có lỗi xảy ra");
                        window.location.href = "./adminpage.php";
                    </script>
                    ';
                    exit();
                }
            }
        }
    ?>

    <div class="container bg-light mt-5 mb-5 col-10 col-sm-5">
        <div class="row">
            <h2 class="fw-bold text-center mt-2">Thêm sản phẩm mới</h2>
        </div>

        <form method="post" action="">
            <p>Tên sản phẩm</p>
            <input type="text" class="form-control mb-3" name="name" placeholder="Name" value="">
            <p>Loại</p>
            <div class="col mb-3">
                <select name="type" class="form-select mt-3">
                    <option value="shoe">shoe</option>
                    <option value="ball">ball</option>
                    <option value="clothes">clothes</option>
                    <option value="goalkeeper">goalkeeper</option>
                    <option value="accessories">accessories</option>
                </select>
            </div>
            <p>Số lượng</p>
            <input type="number" class="form-control mb-3" name="quantity" placeholder="Number" value="">
            <p>Mô tả</p>
            <input type="text" class="form-control mb-3" name="description" placeholder="Description" value="">
            <p>Link hình ảnh</p>
            <input type="text" class="form-control mb-3" name="image" placeholder="Image Link" value="">
            <p>Giá</p>
            <input type="text" class="form-control mb-3" name="price" placeholder="Price" value="">

            <div class="row">
                <div class="col">
                    <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Submit">
                </div>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>