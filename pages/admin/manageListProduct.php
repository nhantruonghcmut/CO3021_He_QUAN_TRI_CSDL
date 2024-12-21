<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>
  <a href="admin.php?page=createProduct" class="btn btn-success btn-icon-split mb-2">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Thêm sản phẩm</span>
  </a>
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <!-- Content Row -->
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
          <tbody>
            <?php
            require_once('./../../adminconfig/config-database.php');
            $conn = openCon();

            // Bắt đầu transaction
            $conn->begin_transaction();
            try {
              $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
              if ($keyword != '') {
                $query = "SELECT * FROM product WHERE name LIKE '%$keyword%'";
                $result = $conn->query($query);
              } else {
                $query = "SELECT * FROM product";
                $result = $conn->query($query);
              }
              if ($result->num_rows > 0) {
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
                        <td>" . $row["price"] . " VNĐ</td>
                        <td>
                            <a href='./../adminpage/updateproduct.php?id=" . $row["id"] . "'><button class='btn btn-primary'>Sửa</button></a>
                            <a href='./../adminpage/deleteproduct.php?id=" . $row["id"] . "'><button class='btn btn-danger'>Xóa</button></a>
                        </td>
                    </tr>
                  ";
                }
              }

            } catch (Exception $exception) {
              //Rollback giao dịch nếu có lỗi
              $conn->rollback();
              echo "Transaction thất bại: " . $exception->getMessage() . "";
            }
            CloseCon($conn)
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
