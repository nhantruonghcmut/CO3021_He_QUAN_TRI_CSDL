<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Update Product Form</title>
</head>

<body>
	<?php
	if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST["submit"] == "Submit") {
			$id = $_GET['id'];
			$name = $_POST["name"];
			$quantity = $_POST["quantity"];
			$description = $_POST["description"];
			$image = $_POST["image"];
			$price = $_POST["price"];

			require_once('./../../adminconfig/config-database.php');
			$conn = openCon();
			try {
				$conn->begin_transaction();
				$query = "UPDATE product SET name = '$name', type = type, quantity = '$quantity', description = '$description', image = '$image', price = '$price' WHERE id = '$id'";
				$result = $conn->query($query);

				if ($result) {
					echo
						'
                        <script>
                            alert("Sửa sản phẩm thành công");
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
			<h2 class="fw-bold text-center mt-2">Cập nhật sản phẩm</h2>
		</div>

		<?php
		$id = $_GET['id'];
		require_once('./../../adminconfig/config-database.php');
		$conn = openCon();
		$query = "SELECT * FROM product WHERE id = '$id'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		?>

		<form method="post" action="">
			<p>ID</p>
			<input disabled type="text" class="form-control mb-3" name="id" placeholder="ID"
				value="<?php echo $data['id']; ?>">
			<p>Tên sản phẩm</p>
			<input type="text" class="form-control mb-3" name="name" placeholder="Name" value="<?php echo $data['name']; ?>">
			<p>Số lượng</p>
			<input type="number" class="form-control mb-3" name="quantity" placeholder="Number"
				value="<?php echo $data['quantity']; ?>">
			<p>Mô tả</p>
			<input type="text" class="form-control mb-3" name="description" placeholder="Description"
				value="<?php echo $data['description']; ?>">
			<p>Link hình ảnh</p>
			<input type="text" class="form-control mb-3" name="image" placeholder="Image Link"
				value="<?php echo $data['image']; ?>">
			<p>Giá</p>
			<input type="text" class="form-control mb-3" name="price" placeholder="Price"
				value="<?php echo $data['price']; ?>">

			<div class="row">
				<div class="col">
					<input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Submit">
				</div>
			</div>
		</form>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
		crossorigin="anonymous"></script>
</body>

</html>