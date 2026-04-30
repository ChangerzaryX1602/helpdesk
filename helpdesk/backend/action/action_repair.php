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
	$r_no = $_POST['r_no'];
	$eq_id = $_POST['eq_id'];
	$r_name = $_POST['r_name'];
	$r_serialnumber = $_POST['r_serialnumber'];
	$r_detail = $_POST['r_detail'];
	$build_id = $_POST['build_id'];
	$floor = $_POST['floor'];
	$room = $_POST['room'];

	
	$sql = "UPDATE tb_repair SET 
	eq_id = '$eq_id',
	r_name = '$r_name',
	r_serialnumber = '$r_serialnumber',
	r_detail = '$r_detail',
	build_id = '$build_id',
	floor = '$floor',
	room = '$room'
	WHERE r_no = '$r_no'";
	$query = mysqli_query($conn, $sql);
	if($query)
	{
		echo '
			<script>
				swal({
					title: "แก้ไขข้อมูลการแจ้งซ่อมสำเร็จ",
					icon: "success",
					button: "ตกลง",
					}).then( () => {
					location.href = "../repair.php"
				});	
			</script>
		';		
	}
	else
	{
		echo '
			<script>
				swal({
					title: "เกิดข้อผิดพลาด Error",
					icon: "error",
					button: "ตกลง",
					}).then( () => {
					location.href = "../repair.php"
				});	
			</script>
		';
		
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>
