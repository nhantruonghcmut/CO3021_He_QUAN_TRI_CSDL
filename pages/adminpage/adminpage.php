<!-- https://www.fundaofwebit.com/post/how-to-make-search-box-and-filter-data-in-html-table-from-database-in-php-mysql -->
<div class="container-fluid">
	<div class="row mb-3">
		<div class="col-xl-9 col-md-6">

			<h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>
			<a href="admin.php?page=createProduct" class="btn btn-success btn-icon-split mb-2">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Thêm sản phẩm</span>
			</a>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
								Tổng số lượng sản phẩm trong kho
							</div>
							<?php
							require_once('./../../adminconfig/config-database.php');
							$conn = openCon();
							try {
								$conn->begin_transaction();
								$sumQuery = "SELECT SUM(quantity) AS total_quantity FROM product;";
								$sumResult = $conn->query($sumQuery);
								$sum = 0;
								if ($sumResult->num_rows > 0) {
									$sumRow = $sumResult->fetch_assoc();
									$sum = $sumRow['total_quantity'];
								}
								echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>" . number_format($sum, 0, ',', '.') . "</div>";
								$conn->commit();
							} catch (Exception $exception) {
								$conn->rollback();
								echo "Transaction thất bại: " . $exception->getMessage() . "";
							}
							?>
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow mb-4">
		<div class="card-body">
			<form id="searchForm" name='search' action="" method="post">
				<div class="row mb-3">
					<div class="col-4">
						Truy vấn đơn
						<div class="input-group">
							<input id="keyword" name="keyword" type="text" class="form-control" value="<?php if (isset($_POST['keyword'])) {
								echo $_POST['keyword'];
							} ?>" aria-label="Tìm theo tên, giá, số lượng, mô tả" aria-describedby="basic-addon2"
								placeholder="Tìm theo tên, giá, số lượng, mô tả">

						</div>
					</div>
					<div class="col-4">
						Truy vấn với điều kiện tổng hợp
						<div class="input-group">
							<input id="priceCondition" name="priceCondition" type="text" class="form-control" value="<?php if (isset($_POST['priceCondition'])) {
								echo $_POST['priceCondition'];
							} ?>" aria-label="Giá lớn hơn xxxx đồng" aria-describedby="basic-addon2" placeholder="Giá lớn hơn xxxx đồng">
						</div>
					</div>
					<div class="col-4 d-flex align-items-end">
						<input type="submit" class="btn btn-primary" id="basic-addon2" value="Tìm">
					</div>
			</form>
		</div>
		<div class="table-responsive" id="productTableContainer">
			<!-- Content Row -->

			<?php
			function formatCurrency($number)
			{
				return number_format($number, 0, ',', '.') . ' VNĐ';
			}

			// Bắt đầu transaction
			$conn->begin_transaction();
			try {
				$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
				$priceCondition = isset($_POST['priceCondition']) ? $_POST['priceCondition'] : '';
				if ($keyword != '' && $priceCondition != '') {
					$query = "SELECT * FROM product WHERE CONCAT(name,description,quantity) LIKE '%$keyword%' AND price > '$priceCondition'";
					echo "Query: " . $query . "</br>";
					$result = $conn->query($query);
				} else if ($keyword != '') {
					$query = "SELECT * FROM product WHERE CONCAT(name,description,quantity) LIKE '%$keyword%'";
					$result = $conn->query($query);
				} else {
					$query = "SELECT * FROM product";
					$result = $conn->query($query);
				}
				if ($result->num_rows > 0) {
					// echo "Tìm thấy " . $result->num_rows . " sản phẩm";
					echo "<table class='table table-bordered' id='productTable' width='100%'>
								<thead>
										<tr>
												<th scope='col'>ID</th>
												<th scope='col'>Tên sản phẩm</th>
												<th scope='col'>Loại</th>
												<th scope='col'>Số lượng</th>
												<th scope='col'>Mô tả</th>
												<th scope='col'>Hình ảnh</th>
												<th scope='col'>Giá</th>
												<th scope='col'>Tác vụ</th>
										</tr>
								</thead>
								<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo
							"
					<tr>
						<th scope='row'>" . $row["id"] . "</th>
						<td>" . $row["name"] . "</td>
						<td>" . $row["type"] . "</td>
						<td>" . $row["quantity"] . "</td>
						<td>" . $row["description"] . "</td>
						<td>
							<img src='" . $row["image"] . "' alt='...' style='height:40px; width: 40px;'>
						</td>
						<td>" . formatCurrency($row["price"]) . "</td>
						<td>
							<a href='./../adminpage/updateproduct.php?id=" . $row["id"] . "'><button class='btn btn-primary'>Sửa</button></a>
							<a href='./../adminpage/deleteproduct.php?id=" . $row["id"] . "'><button class='btn btn-danger'>Xóa</button></a>
						</td>
					</tr>
					";
					}
					echo "</tbody></table>";
				} else {
					echo "<p>Không tìm thấy sản phẩm nào.</p>";
				}

			} catch (Exception $exception) {
				//Rollback giao dịch nếu có lỗi
				$conn->rollback();
				echo "Transaction thất bại: " . $exception->getMessage() . "";
			}
			CloseCon($conn)
				?>
		</div>
	</div>
</div>
</div>
<script>
	document.querySelector('input[type="submit"]').addEventListener('click', e => {

		e.preventDefault();

		let fd = new FormData(document.forms.search);

		fetch(location.href, { method: 'post', body: fd })
			.then(r => r.text())
			.then(html => {
				// Tạo một DOM tạm để phân tích HTML trả về
				const tempDiv = document.createElement('div');
				tempDiv.innerHTML = html;

				// Lấy phần <tbody> từ kết quả trả về
				const newTbody = tempDiv.querySelector('table tbody');
				const currentTbody = document.querySelector('#productTable tbody'); // Phần tbody hiện tại

				if (newTbody && currentTbody) {
					currentTbody.innerHTML = newTbody.innerHTML; // Chỉ thay thế nội dung bên trong <tbody>
				} else {
					console.error('Không tìm thấy <tbody> trong kết quả trả về hoặc trong bảng hiện tại.');
				}
			}).catch((error) => {
				console.error('Lỗi xảy ra:', error);
			});
	});
</script>