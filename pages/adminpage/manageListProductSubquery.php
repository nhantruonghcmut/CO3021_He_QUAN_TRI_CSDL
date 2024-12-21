<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm có giá lớn hơn giá trung bình của các đơn hàng</h1>
  <a href="admin.php?page=createProduct" class="btn btn-success btn-icon-split mb-2">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Thêm sản phẩm</span>
  </a>
  <div class="card shadow mb-4">
    <div class="card-body">
      <p>
        Query with a subquery - Truy vấn sản phẩm nào mà có giá lớn hơn giá trung bình của các đơn hàng.

        <?php
        function formatCurrency($number)
        {
          return number_format($number, 0, ',', '.') . ' VNĐ';
        }
        require_once('./../../adminconfig/config-database.php');
        $conn = openCon();
        try {
          $conn->begin_transaction();
          // Lấy giá trung bình của các đơn hàng
          $avgQuery = "SELECT AVG(price_sell) AS avg_price FROM orders";
          $avgResult = $conn->query($avgQuery);
          $avgPrice = 0;
          if ($avgResult->num_rows > 0) {
            $avgRow = $avgResult->fetch_assoc();
            $avgPrice = $avgRow['avg_price'];
          }
          echo "Giá trung bình của các đơn hàng: " . formatCurrency($avgPrice) . "";
          $conn->commit();
        } catch (Exception $exception) {
          $conn->rollback();
          echo "Transaction thất bại: " . $exception->getMessage() . "";
        }

        ?>
      </p>
      <div class="table-responsive">
        <?php
        try {
          $conn->begin_transaction();
          $query = "SELECT * FROM product
                        WHERE price > (SELECT AVG(price_sell) FROM orders);";
          $result = $conn->query($query);
          $conn->commit();
          if ($result->num_rows > 0) {
            // echo "Tìm thấy " . $result->num_rows . " sản phẩm";
            echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
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