<?php
	
	//ลบ Position			
	if(isset($_POST['btnDeletePosition'])){
		$p_id = $_POST['p_id'];
		
		$sqlcheck1 = "SELECT p_id AS p_id FROM tb_user WHERE p_id = '$p_id'";
		$querycheck1 = mysqli_query($conn, $sqlcheck1);
		$rowcheck1 = mysqli_fetch_array($querycheck1);
		$p_id2 = $rowcheck1['p_id'];
		
		if($p_id2 != $p_id)
		{
			$sqld1 = "DELETE FROM tb_position WHERE p_id = '$p_id'";
			$queryd1 = mysqli_query($conn, $sqld1);
			if($queryd1){
				echo '
					<script>
						swal({
							title: "ลบข้อมูลสำเร็จ", 
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
							title: "Error ลบข้อมูลไม่สำเร็จ", 
							icon: "error",
							button: "ตกลง",
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';	
			}
		}
		else
		{
			echo '
					<script>
						swal({
							title: "ไม่สามารถลบข้อมูลได้", 
							text: "เนื่องจากข้อมูลถูกนำไปใช้อ้างอิงแล้ว",
							icon: "warning",
							button: "ตกลง",
  							dangerMode: true,
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';
		}
		
	}
	
	
	//ลบ Department		
	if(isset($_POST['btnDeleteDepartment'])){
		$dep_id = $_POST['dep_id'];
		
		$sqlcheck2 = "SELECT dep_id AS dep_id FROM tb_user WHERE dep_id = '$dep_id'";
		$querycheck2 = mysqli_query($conn, $sqlcheck2);
		$rowcheck2 = mysqli_fetch_array($querycheck2);
		$dep_id2 = $rowcheck2['dep_id'];
		
		if($dep_id2 != $dep_id)
		{
			$sqld2 = "DELETE FROM tb_department WHERE dep_id = '$dep_id'";
			$queryd2 = mysqli_query($conn, $sqld2);
			if($queryd2){
				echo '
					<script>
						swal({
							title: "ลบข้อมูลสำเร็จ", 
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
							title: "Error ลบข้อมูลไม่สำเร็จ", 
							icon: "error",
							button: "ตกลง",
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';	
			}
		}
		else
		{
			echo '
					<script>
						swal({
							title: "ไม่สามารถลบข้อมูลได้", 
							text: "เนื่องจากข้อมูลถูกนำไปใช้อ้างอิงแล้ว",
							icon: "warning",
							button: "ตกลง",
  							dangerMode: true,
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';
		}
		
	}
	
	//ลบ Equipment		
	if(isset($_POST['btnDeleteEquipment'])){
		$eq_id = $_POST['eq_id'];
		
		$sqlcheck3 = "SELECT eq_id AS eq_id FROM tb_repair WHERE eq_id = '$eq_id'";
		$querycheck3 = mysqli_query($conn, $sqlcheck3);
		$rowcheck3 = mysqli_fetch_array($querycheck3);
		$eq_id2 = $rowcheck3['eq_id'];
		
		if($eq_id2 != $eq_id)
		{
			$sqld3 = "DELETE FROM tb_equipment WHERE eq_id = '$eq_id'";
			$queryd3 = mysqli_query($conn, $sqld3);
			if($queryd3){
				echo '
					<script>
						swal({
							title: "ลบข้อมูลสำเร็จ", 
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
							title: "Error ลบข้อมูลไม่สำเร็จ", 
							icon: "error",
							button: "ตกลง",
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';	
			}
		}
		else
		{
			echo '
					<script>
						swal({
							title: "ไม่สามารถลบข้อมูลได้", 
							text: "เนื่องจากข้อมูลถูกนำไปใช้อ้างอิงแล้ว",
							icon: "warning",
							button: "ตกลง",
  							dangerMode: true,
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';
		}
		
	}
	
	//ลบ tb_building		
	if(isset($_POST['btnDeleteBuilding'])){
		$build_id = $_POST['build_id'];
		
		$sqlcheck4 = "SELECT build_id AS build_id FROM tb_repair WHERE build_id = '$build_id'";
		$querycheck4 = mysqli_query($conn, $sqlcheck4);
		$rowcheck4 = mysqli_fetch_array($querycheck4);
		$build_id2 = $rowcheck4['build_id'];
		
		if($build_id2 != $build_id)
		{
			$sqld4 = "DELETE FROM tb_building WHERE build_id = '$build_id'";
			$queryd4 = mysqli_query($conn, $sqld4);
			if($queryd4){
				echo '
					<script>
						swal({
							title: "ลบข้อมูลสำเร็จ", 
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
							title: "Error ลบข้อมูลไม่สำเร็จ", 
							icon: "error",
							button: "ตกลง",
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';	
			}
		}
		else
		{
			echo '
					<script>
						swal({
							title: "ไม่สามารถลบข้อมูลได้", 
							text: "เนื่องจากข้อมูลถูกนำไปใช้อ้างอิงแล้ว",
							icon: "warning",
							button: "ตกลง",
  							dangerMode: true,
							}).then( () => {
								location.href = "'.$_SERVER['REQUEST_URI'].'"
											
							});	
					</script>
				';
		}
	}
	
	//ยกเลิกการซ่อม
	if(isset($_POST['btnCancelRepair'])){
		$r_no = $_POST['r_no'];
		$s_id = "5";
		
		$sqld5 = "UPDATE tb_repair SET s_id = '$s_id' WHERE r_no = '$r_no'";
		$queryd5 = mysqli_query($conn, $sqld5);
		if($queryd5){
			echo '
				<script>
					swal({
						title: "ยกเลิกรายการซ่อมสำเร็จ", 
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
						title: "Error ยกเลิกรายการซ่อมไม่ได้", 
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
