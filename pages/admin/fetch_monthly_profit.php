<?php
require_once("../../adminconfig/config-database.php");
header('Content-Type: application/json');

$conn = OpenCon();
$stmt = $conn->prepare("CALL calculate_monthly_profit()");
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
CloseCon($conn);

// Trả về JSON
if (!$result) {
    echo json_encode(["profitData" => []]); // Đảm bảo JSON trả về luôn đúng
} else {
    echo json_encode(["profitData" => $result]);
}
?>
