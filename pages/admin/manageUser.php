<?php
require_once('./../../adminconfig/config-database.php');
$conn = openCon();

// Lấy dữ liệu từ form
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : null;

// Cài đặt phân trang
$limit = 10; // Số lượng người dùng mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn hiển thị tất cả người dùng với tổng số order
$all_users_query = "
    SELECT u.id, u.username, u.email, COUNT(o.orderId) AS total_orders
    FROM users u
    LEFT JOIN orders o ON u.id = o.userId
    GROUP BY u.id
    LIMIT $limit OFFSET $offset";
$all_users_result = $conn->query($all_users_query);

// Truy vấn để lấy tổng số người dùng để tính số trang
$total_users_query = "
    SELECT COUNT(u.id) AS total_users
    FROM users u
    LEFT JOIN orders o ON u.id = o.userId";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total_users'];
$total_pages = ceil($total_users / $limit);

// Truy vấn lọc
$filtered_users_query = null;
if ($start_date && $end_date && $filter_type) {
    if ($filter_type === "max") {
        $filtered_users_query = "
            SELECT u.id, u.username, COUNT(o.orderId) AS total_orders
            FROM users u
            LEFT JOIN orders o ON u.id = o.userId
            WHERE o.orderdate BETWEEN '$start_date' AND '$end_date'
            GROUP BY u.id
            ORDER BY total_orders DESC
            LIMIT 5";
    } elseif ($filter_type === "min") {
        $filtered_users_query = "
            SELECT u.id, u.username, COUNT(o.orderId) AS total_orders
            FROM users u
            LEFT JOIN orders o ON u.id = o.userId
            WHERE o.orderdate BETWEEN '$start_date' AND '$end_date'
            GROUP BY u.id
            ORDER BY total_orders ASC
            LIMIT 5";
    }
    $filtered_users_result = $conn->query($filtered_users_query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản lý người dùng</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php?page=dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BK SHOP ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin.php?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lý
            </div>

            <!-- Nav Item - Quản lý người dùng -->
            <li class="nav-item">
                <a class="nav-link" href="manageUser.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Quản lý người dùng</span></a>
            </li>

            <!-- Nav Item - Quản lý sản phẩm -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=manageListProduct">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Quản lý sản phẩm</span></a>
            </li>

            <!-- Nav Item - Quản lý giao dịch -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=manageTransaction">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý giao dịch</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Quản lý Người Dùng</h1>

                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Ngày bắt đầu:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">Ngày kết thúc:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="filter_type">Lọc:</label>
                                <select id="filter_type" name="filter_type" class="form-control">
                                    <option value="">--Chọn--</option>
                                    <option value="max">Nhiều nhất</option>
                                    <option value="min">Ít nhất</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Lọc</button>
                    </form>

                    <?php if ($filtered_users_query): ?>
                        <h2 class="mt-4">Kết quả lọc</h2>
                        <?php if ($filtered_users_result->num_rows > 0): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Tổng số Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $filtered_users_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['username'] ?></td>
                                            <td><?= $row['total_orders'] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Không tìm thấy người dùng nào theo bộ lọc.</p>
                        <?php endif; ?>
                    <?php endif; ?>


                    <!-- Hiển thị toàn bộ user -->
        <h2>Danh sách tất cả người dùng</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tổng số Orders</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $all_users_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['total_orders']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a> 
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
// Cài đặt phân trang
$limit = 10; // Số lượng người dùng mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn để lấy tổng số người dùng để tính số trang
$total_users_query = "
    SELECT COUNT(u.id) AS total_users
    FROM users u
    LEFT JOIN orders o ON u.id = o.userId";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total_users'];
$total_pages = ceil($total_users / $limit);

// Thiết lập phạm vi trang hiển thị: chỉ hiển thị 5 trang gần với trang hiện tại
$range = 2; // Số trang trước và sau trang hiện tại để hiển thị
$start_page = max(1, $page - $range);
$end_page = min($total_pages, $page + $range);
?>

<!-- Phân trang -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Liên kết "Trước" -->
        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>" tabindex="-1">Trước</a>
        </li>

        <!-- Liên kết các trang -->
        <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>

        <!-- Liên kết "Sau" -->
        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo min($total_pages, $page + 1); ?>">Sau</a>
        </li>
    </ul>
</nav>

    </div>
</div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Bản quyền &copy; Quản lý người dùng 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
