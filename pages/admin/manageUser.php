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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #575d63;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 class="text-center text-white">Quản lý người dùng</h3>
</div>

<!-- Content -->
<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Quản lý Người Dùng</h1>

        <!-- Form lọc -->
        <form method="GET" action="" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Ngày kết thúc:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="filter_type" class="form-label">Lọc:</label>
                    <select id="filter_type" name="filter_type" class="form-select">
                        <option value="">--Chọn--</option>
                        <option value="max">Nhiều nhất</option>
                        <option value="min">Ít nhất</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lọc</button>
        </form>

        <hr>

        <!-- Hiển thị kết quả lọc -->
        <?php if ($filtered_users_query): ?>
            <h2>Kết quả lọc</h2>
            <?php if ($filtered_users_result->num_rows > 0) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Tổng số Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $filtered_users_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['total_orders']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>Không tìm thấy người dùng nào theo bộ lọc.</p>
            <?php } ?>
        <?php endif; ?>

        <hr>

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
