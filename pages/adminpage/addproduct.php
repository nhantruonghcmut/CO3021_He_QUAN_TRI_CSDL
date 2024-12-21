<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submit"] == "Submit") {
        $name = $_POST["name"];
        $type = $_POST["type"];
        $quantity = $_POST["quantity"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        $price = $_POST["price"];

        require_once('./../../adminconfig/config-database.php');
        $conn = openCon();
        try {
            $conn->begin_transaction();
            $query = "INSERT INTO product (name, type, price, quantity, description, image) VALUES ('$name', '$type', '$price', '$quantity', '$description', '$image')";
            $result = $conn->query($query);

            if ($result) {
                echo
                    '
                        <script>
                            alert("Thêm sản phẩm thành công");
                            window.location.href = "./../admin/admin.php?page=manageListProduct";
                        </script>
                        ';
                $conn->commit();
            } else {
                echo
                    '
                        <script>
                            alert("Có lỗi xảy ra");
                        </script>
                        ';
                $conn->rollback();
            }
        } catch (Exception $exception) {
            //Rollback giao dịch nếu có lỗi
            $conn->rollback();
            echo "Transaction thất bại: " . $exception->getMessage() . "";
        }
        CloseCon($conn);
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
        <select name="type" class=" form-control form-select mt-3  mb-3" aria-label="Default select example">
            <option value="shoe">shoe</option>
            <option value="ball">ball</option>
            <option value="clothes">clothes</option>
            <option value="goalkeeper">goalkeeper</option>
            <option value="accessories">accessories</option>
        </select>
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
                <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit"
                    value="Submit">
            </div>
        </div>
    </form>

</div>