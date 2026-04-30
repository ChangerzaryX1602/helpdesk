<?php
session_start();
include('../../config/connect.php');
include('repair_tracking_helper.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="../../js/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100&display=swap" rel="stylesheet">
	<link href="../assets/css/custom.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
<?php
$r_no = $_POST['r_no'];
$eq_id = (int) $_POST['eq_id'];
$r_name = trim($_POST['r_name']);
$r_serialnumber = trim($_POST['r_serialnumber']);
$r_detail = trim($_POST['r_detail']);
$build_id = (int) $_POST['build_id'];
$floor = trim($_POST['floor']);
$room = trim($_POST['room']);
$currentRepair = repairGetCurrentRepairRow($conn, $r_no);

$sql = "UPDATE tb_repair SET
			eq_id = $eq_id,
			r_name = '" . repairEscape($conn, $r_name) . "',
			r_serialnumber = '" . repairEscape($conn, $r_serialnumber) . "',
			r_detail = '" . repairEscape($conn, $r_detail) . "',
			symptom_summary = '" . repairEscape($conn, substr($r_detail !== '' ? $r_detail : $r_name, 0, 255)) . "',
			build_id = $build_id,
			floor = '" . repairEscape($conn, $floor) . "',
			room = '" . repairEscape($conn, $room) . "'
		WHERE r_no = '" . repairEscape($conn, $r_no) . "'";
$query = mysqli_query($conn, $sql);

if ($query) {
	$userId = isset($_SESSION['u_idcard']) ? $_SESSION['u_idcard'] : ($currentRepair ? $currentRepair['u_idcard'] : '');
	$statusId = $currentRepair ? $currentRepair['s_id'] : '1';
	$technicianId = $currentRepair ? $currentRepair['technician_id'] : '';
	repairInsertComment($conn, $r_no, $userId, 'มีการแก้ไขรายละเอียดงานซ่อม', 'update');
	repairInsertLog(
		$conn,
		$r_no,
		$statusId,
		$technicianId,
		$userId,
		gethostbyaddr($_SERVER['REMOTE_ADDR']),
		$_SERVER['REMOTE_ADDR'],
		isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown',
		date('Y-m-d H:i:s'),
		'update',
		$statusId,
		'มีการแก้ไขรายละเอียดงานซ่อม'
	);

	echo '
		<script>
			swal({
				title: "แก้ไขข้อมูลการแจ้งซ่อมสำเร็จ",
				icon: "success",
				button: false,
				timer: 1200,
				closeOnClickOutside: false,
				closeOnEsc: false,
			}).then(() => {
				location.href = "../list_repair.php"
			});
		</script>
	';
} else {
	echo '
		<script>
			swal({
				title: "เกิดข้อผิดพลาด",
				text: "กรุณาทำรายการใหม่อีกครั้ง",
				icon: "error",
				button: "ตกลง",
			}).then(() => {
				location.href = "../list_repair.php"
			});
		</script>
	';
}

mysqli_close($conn);
?>
</div>
</body>
</html>
