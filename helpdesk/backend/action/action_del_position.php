<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="../../js/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100&display=swap" rel="stylesheet">
    <style type="text/css">
		body{
			font-size: 14px;
			font-family: 'Prompt', sans-serif;
			color:#000;
		}
		.swal-footer {
			text-align:center;
			font-family: 'Prompt', sans-serif;
		}
	</style>
</head>
<body>
<div align="center">
<?php
	include('../../config/connect.php');
	$p_id = $_GET['p_id'];
	
	$sql = "DELETE FROM tb_position WHERE p_id = '$p_id'";
	$query = mysqli_query($conn, $sql);
	if($query)
	{
		echo '
			<script>
				swal({
					title: "ลบข้อมูลสำเร็จ",
					icon: "success",
					button: "ตกลง",
					}).then( () => {
					location.href = "../list_position.php"
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
					location.href = "../list_position.php"
				});	
			</script>
		';
		
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>
