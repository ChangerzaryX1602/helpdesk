<?php
session_start();
include('config/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="js/sweetalert.min.js"></script>
</head>
<body>
<?php
$u_idcard           = trim($_POST['u_idcard']);
$u_password_new     = $_POST['u_password_new'];
$u_password_confirm = $_POST['u_password_confirm'];

if (!preg_match('/^\d{13}$/', $u_idcard)) {
	echo '
		<script>
			swal({
				title: "ข้อมูลไม่ถูกต้อง",
				text: "เลขบัตรประชาชนไม่ถูกต้อง",
				icon: "warning",
				button: "ตกลง",
			}).then(() => { location.href = "forgot_password.php"; });
		</script>
	';
	mysqli_close($conn);
	exit();
}

if (strlen($u_password_new) < 4) {
	echo '
		<script>
			swal({
				title: "รหัสผ่านสั้นเกินไป",
				text: "รหัสผ่านต้องมีอย่างน้อย 4 ตัวอักษร",
				icon: "warning",
				button: "ตกลง",
			}).then(() => { history.back(); });
		</script>
	';
	mysqli_close($conn);
	exit();
}

if ($u_password_new !== $u_password_confirm) {
	echo '
		<script>
			swal({
				title: "รหัสผ่านไม่ตรงกัน",
				text: "กรุณายืนยันรหัสผ่านใหม่ให้ตรงกัน",
				icon: "warning",
				button: "ตกลง",
			}).then(() => { history.back(); });
		</script>
	';
	mysqli_close($conn);
	exit();
}

$u_idcard_safe = mysqli_real_escape_string($conn, $u_idcard);
$check  = mysqli_query($conn, "SELECT u_idcard, u_status FROM tb_user WHERE u_idcard = '$u_idcard_safe' LIMIT 1");
$result = mysqli_fetch_array($check);

if (!$result) {
	echo '
		<script>
			swal({
				title: "ไม่พบผู้ใช้งาน",
				text: "ไม่พบเลขบัตรประชาชนนี้ในระบบ",
				icon: "error",
				button: "ตกลง",
			}).then(() => { location.href = "forgot_password.php"; });
		</script>
	';
	mysqli_close($conn);
	exit();
}

if ($result['u_status'] != '1') {
	echo '
		<script>
			swal({
				title: "บัญชีถูกระงับ",
				text: "บัญชีนี้ถูกระงับการใช้งาน กรุณาติดต่อผู้ดูแลระบบ",
				icon: "warning",
				button: "ตกลง",
			}).then(() => { location.href = "index.php"; });
		</script>
	';
	mysqli_close($conn);
	exit();
}

$u_password_md5 = md5($u_password_new);
$update = mysqli_query($conn, "UPDATE tb_user SET u_password = '$u_password_md5' WHERE u_idcard = '$u_idcard_safe'");

if ($update) {
	echo '
		<script>
			swal({
				title: "เปลี่ยนรหัสผ่านสำเร็จ",
				text: "กรุณาเข้าสู่ระบบด้วยรหัสผ่านใหม่",
				icon: "success",
				button: "ตกลง",
			}).then(() => { location.href = "index.php"; });
		</script>
	';
} else {
	echo '
		<script>
			swal({
				title: "เกิดข้อผิดพลาด",
				text: "ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาลองใหม่อีกครั้ง",
				icon: "error",
				button: "ตกลง",
			}).then(() => { history.back(); });
		</script>
	';
}

mysqli_close($conn);
?>
</body>
</html>
