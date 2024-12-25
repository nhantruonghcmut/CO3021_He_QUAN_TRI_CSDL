<?php
require_once("../../adminconfig/config-database.php");
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_monthly_revenue()");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>

// fetch_type_revenue.php
<?php
require_once('config-database.php');
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_type_revenue()");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>

// fetch_orders_count.php
<?php
require_once('config-database.php');
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_current_month_orders()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>

// fetch_inventory_ratio.php
<?php
require_once('config-database.php');
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_inventory_ratio()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>

// fetch_monthly_profit.php
<?php
require_once('config-database.php');
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_monthly_profit()");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>

// fetch_current_profit.php
<?php
require_once('config-database.php');
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_current_month_profit()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>