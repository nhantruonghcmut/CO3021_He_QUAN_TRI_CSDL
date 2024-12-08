<?php
$servername = "";
$username = "";
$password = "";
$dbname = "sportshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$userId = isset($_GET['userId']) ? $_GET['userId'] : '';
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

if (empty($userId) && empty($orderId) && empty($startDate) && empty($endDate)) {
    $sql = "SELECT * FROM orders LIMIT 400";
} else {
    $sql = "SELECT * FROM orders WHERE 1=1";

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

    $sql .= " LIMIT 100";
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


if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
} else {
    $orders = [];
}

echo json_encode($orders);  
$conn->close();
?>