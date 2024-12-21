<?php
require_once("../../adminconfig/config-database.php");
$conn = openCon();

$userId = isset($_GET['userId']) ? $_GET['userId'] : '';
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20; 
$offset = ($page - 1) * $limit;

if (empty($userId) && empty($orderId) && empty($startDate) && empty($endDate)) {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM orders join users on userId = id LIMIT ?, ?";
} else {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM orders join users on userId = id WHERE 1=1";

    if (!empty($userId)) {
        $sql .= " AND userId = ?";
    }

    if (!empty($orderId)) {
        $sql .= " AND orderId = ?";
    }

    if (!empty($startDate)) {
        $sql .= " AND orderdate >= ?";
    }

    if (!empty($endDate)) {
        $sql .= " AND orderdate <= ?";
    }

    $sql .= " LIMIT ?, ?";
}

$stmt = $conn->prepare($sql);

$params = [];
$types = "";
if (!empty($userId)) {
    $params[] = $userId;
    $types .= "s";
}
if (!empty($orderId)) {
    $params[] = $orderId;
    $types .= "s";
}
if (!empty($startDate)) {
    $params[] = $startDate;
    $types .= "s";
}
if (!empty($endDate)) {
    $params[] = $endDate;
    $types .= "s";
}

$params[] = $offset;
$params[] = $limit;
$types .= "ii";

if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$totalResult = $conn->query("SELECT FOUND_ROWS() as total");
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

echo json_encode([
    'orders' => $orders,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);

$conn->close();
?>