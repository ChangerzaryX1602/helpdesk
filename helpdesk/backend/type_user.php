<?php 
	if(isset($_SESSION['u_idcard']) == "")
	{
		echo "<script> 
				alert('กรุณาเข้าสู่ระบบก่อน Please Login!');
				window.location='../index.php';
			 </script>";
		exit();
	}

	include('../config/connect.php'); 
	$sqlcheck = "SELECT u.*, d.dep_name, l.level_name, p.p_position FROM tb_user AS u
	INNER JOIN tb_user_level AS l ON u.level_id = l.level_id
	INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
	INNER JOIN tb_position AS p ON u.p_id = p.p_id
	WHERE u.u_idcard = '".$_SESSION['u_idcard']."'";
	$result = mysqli_query($conn, $sqlcheck);
	$record = mysqli_fetch_array($result);
	extract($record);	
?>