<?php session_start();
	include('../../../config/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="../../../js/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100&display=swap" rel="stylesheet">
    <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
<?php
	$p_position = $_POST['p_position'];
	
	$sqlcheck = "SELECT p_id FROM tb_position ORDER BY p_id DESC LIMIT 1";
	$querycheck = mysqli_query($conn, $sqlcheck);
	$numrow = mysqli_fetch_array($querycheck);
	$p_id_max = $numrow['p_id'] + 1;
	
	$sql = "INSERT INTO tb_position(p_id, p_position) VALUES('$p_id_max', '$p_position')";
	$query = mysqli_query($conn, $sql);
	if($query)
	{
		echo '
			<script>
				swal({
					title: "บันทึกข้อมูลสำเร็จ",
					icon: "success",
					button: "ตกลง",
					}).then( () => {
					location.href = "../../list_position.php"
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
					text: "กรุณาทำรายการใหม่อีกครั้ง",
					icon: "error",
					button: "ตกลง",
					}).then( () => {
					location.href = "../../list_position.php"
				});	
			</script>
		';
		
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>
