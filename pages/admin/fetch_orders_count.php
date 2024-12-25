<?php
require_once("../../adminconfig/config-database.php");
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_current_month_orders()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);

// Debugging: Log the result
if (!$result) {
    echo json_encode(["error" => "No data returned"]);
} else {
    echo json_encode($result);
}
?>
