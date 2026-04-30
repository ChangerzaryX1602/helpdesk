<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="js/sweetalert.min.js"></script>
</head>
<body>
     <!-- Connect DB Content -->
<?php
	include('config/connect.php');
	$u_username = $_POST['u_username'];
	$u_password = md5($_POST['u_password']);
	$sql = "SELECT * FROM tb_user WHERE 
	u_username = '".$u_username."' AND 
	u_password = '".$u_password."' AND
	u_status = '1'";
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_array($query);
	if(!$result)
	{
		echo '
			<script>
				swal({
					title: "ลงทะเบียนสำเร็จ",
					icon: "info",
					button: "ตกลง",
					}).then( () => {
					location.href = "index.php"
				});	
			</script>
		';		
	}
	else
	{
		$_SESSION["u_idcard"] = $result["u_idcard"];
		$_SESSION["level_id"] = $result["level_id"];
		session_write_close();		
		if($result["level_id"] == '01')
		{
			include('function_get_login.php');
			header("location:backend/index.php");
		}
		else if($result["level_id"] == '02')
		{ 
			include('function_get_login.php');
			header("location:backend/index.php");
		}
		else if($result["level_id"] == '03')
		{ 
			include('function_get_login.php');
			header("location:backend/index.php");
		}
		else if($result["level_id"] == '04')
		{ 
			include('function_get_login.php');
			header("location:backend/work_repair.php");
		}
		else
		{  
		   header("location:index.php");
		}
	}
	mysqli_close($conn);
?>
</body>
</html>
