<?php session_start();
	include('../../config/connect.php');
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
	$u_prefix = $_POST['u_prefix'];
	$u_fname = $_POST['u_fname'];
	$u_lname = $_POST['u_lname'];
	$u_idcard = $_POST['u_idcard'];
	$u_mobile = $_POST['u_mobile'];
	$u_tel = $_POST['u_tel'];
	$u_email = $_POST['u_email'];
	$p_id = $_POST['p_id'];
	$dep_id = $_POST['dep_id'];
	$u_username = $_POST['u_username'];
	$u_password = md5($_POST['u_password']);
	$level_id = $_POST['level_id'];
	$u_status = '1';
	$u_save = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO tb_user(u_prefix, u_fname, u_lname, u_idcard, u_mobile, u_tel, u_email, p_id, dep_id, u_username, u_password, level_id, u_status, u_save) VALUES('$u_prefix', '$u_fname', '$u_lname', '$u_idcard', '$u_mobile', '$u_tel', '$u_email', $p_id, $dep_id, '$u_username', '$u_password', '$level_id', '$u_status', '$u_save')";
	$query = mysqli_query($conn, $sql);
	if($query)
	{
		echo '
			<script>
				swal({
					title: "บันทึกข้อมูลสำเร็จ",
					icon: "success",
					button: false,
					timer: 1200,
					closeOnClickOutside: false,
					closeOnEsc: false,
					}).then( () => {
					location.href = "../list_user.php"
				});	
			</script>
		';		
	}
	else
	{
		echo '
			<script>
				swal({
					title: "เกิดข้อผิดพลาด",
					text: "กรุณาทำรายการใหม่อีกครั้ง",
					icon: "error",
					button: "ตกลง",
					}).then( () => {
					location.href = "../list_user.php"
				});	
			</script>
		';
		
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>

