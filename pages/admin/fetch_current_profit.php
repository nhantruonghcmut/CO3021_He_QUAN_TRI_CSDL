<?php
require_once("../../adminconfig/config-database.php");
header('Content-Type: application/json');

$conn = OpenCon();
$conn->query("SET SESSION MAX_EXECUTION_TIME=3000");
$stmt = $conn->prepare("CALL calculate_current_month_profit()");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();
CloseCon($conn);

// Trả về JSON
if (!$result) {
    echo json_encode(["profit" => 0]); // Đảm bảo luôn trả về giá trị mặc định
} else {
    echo json_encode($result);
}
?>
