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
$u_idcard = $_POST['u_idcard'];
$eq_id = (int) $_POST['eq_id'];
$r_name = trim($_POST['r_name']);
$r_serialnumber = trim($_POST['r_serialnumber']);
$r_detail = trim($_POST['r_detail']);
$build_id = (int) $_POST['build_id'];
$floor = trim($_POST['floor']);
$room = trim($_POST['room']);
$wl_id = isset($_POST['wl_id']) && $_POST['wl_id'] !== '' ? $_POST['wl_id'] : '1';
$s_id = '1';
$r_save = date('Y-m-d H:i:s');

$sla_due_at = repairCalculateSlaDueAt($conn, $eq_id, $wl_id, $r_save);
$placeholder = 'P' . bin2hex(random_bytes(3));

mysqli_begin_transaction($conn);
$sql = "INSERT INTO tb_repair(
			r_no, u_idcard, eq_id, r_name, r_serialnumber, r_detail, symptom_summary,
			build_id, floor, room, s_id, r_save, sla_due_at, head_id, technician_id, wl_id
		) VALUES (
			'" . repairEscape($conn, $placeholder) . "', '$u_idcard', $eq_id, '" . repairEscape($conn, $r_name) . "', '" . repairEscape($conn, $r_serialnumber) . "',
			'" . repairEscape($conn, $r_detail) . "', '" . repairEscape($conn, substr($r_detail !== '' ? $r_detail : $r_name, 0, 255)) . "',
			$build_id, '" . repairEscape($conn, $floor) . "', '" . repairEscape($conn, $room) . "', '$s_id', '$r_save', '$sla_due_at',
			'', '', '" . repairEscape($conn, $wl_id) . "'
		)";
$query = mysqli_query($conn, $sql);
if ($query) {
	$newNo = mysqli_insert_id($conn);
	$r_no = 'R' . $newNo;
	$query = mysqli_query($conn, "UPDATE tb_repair SET r_no='" . repairEscape($conn, $r_no) . "' WHERE no=" . (int) $newNo);
	if ($query) {
		mysqli_commit($conn);
	} else {
		mysqli_rollback($conn);
	}
} else {
	mysqli_rollback($conn);
}

if ($query) {
	repairInsertComment($conn, $r_no, $u_idcard, 'สร้างรายการแจ้งซ่อมโดยเจ้าหน้าที่: ' . ($r_detail !== '' ? $r_detail : $r_name), 'create');
	repairInsertLog(
		$conn,
		$r_no,
		$s_id,
		'',
		isset($_SESSION['u_idcard']) ? $_SESSION['u_idcard'] : $u_idcard,
		gethostbyaddr($_SERVER['REMOTE_ADDR']),
		$_SERVER['REMOTE_ADDR'],
		isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown',
		$r_save,
		'create',
		null,
		'เจ้าหน้าที่สร้างรายการแจ้งซ่อมแทนผู้ใช้'
	);

	echo '
		<script>
			swal({
				title: "บันทึกข้อมูลการแจ้งซ่อมสำเร็จ",
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
				location.href = "../add_repair.php"
			});
		</script>
	';
}

mysqli_close($conn);
?>
</div>
</body>
</html>
