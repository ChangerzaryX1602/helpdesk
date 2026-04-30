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
$u_prefix   = mysqli_real_escape_string($conn, trim($_POST['u_prefix']));
$u_fname    = mysqli_real_escape_string($conn, trim($_POST['u_fname']));
$u_lname    = mysqli_real_escape_string($conn, trim($_POST['u_lname']));
$u_idcard   = mysqli_real_escape_string($conn, trim($_POST['u_idcard']));
$u_mobile   = mysqli_real_escape_string($conn, trim($_POST['u_mobile']));
$u_tel      = mysqli_real_escape_string($conn, trim($_POST['u_tel']));
$u_email    = mysqli_real_escape_string($conn, trim($_POST['u_email']));
$p_id       = (int) $_POST['p_id'];
$dep_id     = (int) $_POST['dep_id'];
$u_username = mysqli_real_escape_string($conn, trim($_POST['u_username']));
$u_password = md5($_POST['u_password']);
$level_id   = '03';
$u_status   = '1';
$u_save     = date('Y-m-d H:i:s');

$check = mysqli_query($conn, "SELECT u_idcard, u_username FROM tb_user
	WHERE u_idcard = '$u_idcard' OR u_username = '$u_username'");
$dup = mysqli_fetch_array($check);

if ($dup) {
	$msg = ($dup['u_idcard'] == $u_idcard)
		? 'เลขบัตรประชาชนนี้ถูกลงทะเบียนแล้ว'
		: 'Username นี้ถูกใช้งานแล้ว';
	echo '
		<script>
			swal({
				title: "ลงทะเบียนไม่สำเร็จ",
				text: "' . $msg . '",
				icon: "warning",
				button: "ตกลง",
			}).then(() => { history.back(); });
		</script>
	';
	mysqli_close($conn);
	exit();
}

$sql = "INSERT INTO tb_user (
			u_prefix, u_fname, u_lname, u_idcard, u_mobile, u_tel, u_email,
			p_id, dep_id, u_username, u_password, level_id, u_status, u_save
		) VALUES (
			'$u_prefix', '$u_fname', '$u_lname', '$u_idcard', '$u_mobile', '$u_tel', '$u_email',
			$p_id, $dep_id, '$u_username', '$u_password', '$level_id', '$u_status', '$u_save'
		)";
$query = mysqli_query($conn, $sql);

if ($query) {
	echo '
		<script>
			swal({
				title: "ลงทะเบียนสำเร็จ",
				text: "กรุณาเข้าสู่ระบบด้วย Username และ Password ที่ลงทะเบียน",
				icon: "success",
				button: "ตกลง",
			}).then(() => {
				location.href = "index.php";
			});
		</script>
	';
} else {
	echo '
		<script>
			swal({
				title: "เกิดข้อผิดพลาด",
				text: "ไม่สามารถลงทะเบียนได้ กรุณาทำรายการใหม่อีกครั้ง",
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
