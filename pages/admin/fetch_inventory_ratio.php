<?php
require_once("../../adminconfig/config-database.php");
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_inventory_ratio()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);
echo json_encode($result);
?>
