<?php
	//อัปเดต Position
	include('../../../config/connect.php'); 
	if(isset($_POST['btnEditPosition'])){
		$p_id = $_POST['p_id'];
		$p_position = $_POST['p_position'];
		
		$sqlu1 = "UPDATE tb_position SET p_position = '$p_position'
				WHERE p_id = '$p_id'";
		$queryu1 = mysqli_query($conn, $sqlu1);
		if($queryu1){
			echo '
				<script>
					swal({
						title: "แก้ไขข้อมูลสำเร็จ", 
						icon: "success",
						button: "ตกลง",
						}).then( () => {
							location.href = "'.$_SERVER['REQUEST_URI'].'"
										
						});	
				</script>
			';
		}
		else
		{
			echo '
				<script>
					swal({
						title: "Error แก้ไขข้อมูลไม่สำเร็จ", 
						icon: "error",
						button: "ตกลง",
						}).then( () => {
							location.href = "'.$_SERVER['REQUEST_URI'].'"
										
						});	
				</script>
			';	
		}
	}
?>