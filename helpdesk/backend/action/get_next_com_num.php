<?php
session_start();
include('../../config/connect.php');

header('Content-Type: application/json; charset=utf-8');

if (!in_array($_SESSION['level_id'] ?? '', array('01','02','04'))) {
    http_response_code(403);
    echo json_encode(['error' => 'unauthorized']);
    exit();
}

$dep_id = isset($_GET['dep_id']) ? (int) $_GET['dep_id'] : 0;
if ($dep_id <= 0) {
    echo json_encode(['next' => '']);
    exit();
}

$dep_prefix = str_pad((string)$dep_id, 2, '0', STR_PAD_LEFT);

$sql = "SELECT com_num1 FROM tb_equipment_registry
        WHERE dep_id = $dep_id
          AND com_num1 REGEXP '^[0-9]+$'
          AND com_num1 LIKE '" . mysqli_real_escape_string($conn, $dep_prefix) . "%'";
$result = mysqli_query($conn, $sql);

$max_running = 0;
$prefix_len = strlen($dep_prefix);
while ($row = mysqli_fetch_assoc($result)) {
    $com1 = $row['com_num1'];
    if (strlen($com1) > $prefix_len) {
        $running_part = substr($com1, $prefix_len);
        if (ctype_digit($running_part)) {
            $running = (int)$running_part;
            if ($running > $max_running) {
                $max_running = $running;
            }
        }
    }
}

$next_running = $max_running + 1;
$next_com_num1 = $dep_prefix . str_pad((string)$next_running, 4, '0', STR_PAD_LEFT);

echo json_encode(['next' => $next_com_num1]);
mysqli_close($conn);
