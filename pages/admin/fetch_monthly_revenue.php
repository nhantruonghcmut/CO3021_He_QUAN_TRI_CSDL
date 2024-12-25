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