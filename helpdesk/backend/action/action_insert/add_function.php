<?php
	//เพิ่ม Admin
	include('../../config/connect.php'); 
	if(isset($_POST['btnAdmin'])){
		$admin_username = $_POST['admin_username'];
		$admin_password = md5($_POST['admin_password']);
		$admin_name = $_POST['admin_name'];
		$pos_id = "09";
		$admin_level = "1";
		$admin_permission = "0000000000";
		$admin_log_save = date('Y-m-d H:i:s');
		$date = date("d-m-Y");	  		 		 
		$numrand = (mt_rand());
		$upload = $_FILES['admin_img'];
		if($upload <> '') {  
			$path="img-admin/";  
			$type = strrchr($_FILES['admin_img']['name'],".");
			$newname = $date.$numrand.$type;
			$path_copy = $path.$newname;
			$path_link="img-admin/".$newname;
			move_uploaded_file($_FILES['admin_img']['tmp_name'],$path_copy);  	
		}
		
		$sqlx = "INSERT INTO tb_admin(admin_username, admin_password, admin_name, pos_id, admin_img, admin_level, admin_permission, admin_log_save) VALUES('$admin_username', '$admin_password', '$admin_name', '$pos_id', '$newname', '$admin_level', '$admin_permission', '$admin_log_save')";
		$queryx = mysqli_query($conn, $sqlx);
		if($queryx){
			echo '
				<script>
					swal({
						title: "บันทึกข้อมูลสำเร็จ", 
						text: "กรุณากด ตกลง เพื่อดำเนินการต่อไป",
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
						title: "Error บันทึกข้อมูลไม่สำเร็จ", 
						text: "กรุณากด ตกลง เพื่อดำเนินการต่อไป",
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


<?php
	//เพิ่ม Member
	if(isset($_POST['btnMember'])){
		$m_username = $_POST['m_username'];
		$m_password = md5($_POST['m_password']);
		$m_prefix = $_POST['m_prefix'];
		$m_fname = $_POST['m_fname'];
		$m_lname = $_POST['m_lname'];
		$m_idcard = $_POST['m_idcard'];
		$m_tel = $_POST['m_tel'];
		$m_idline = $_POST['m_idline'];
		$m_email = $_POST['m_email'];
		$pos_id = $_POST['pos_id'];
		$m_status = "1";
		$m_save = date('Y-m-d H:i:s');
		$date = date("d-m-Y");	  		 		 
		$numrand = (mt_rand());
		$upload = $_FILES['m_img'];
		if($upload <> '') {  
			$path="img-member/";  
			$type = strrchr($_FILES['m_img']['name'],".");
			$newname = $date.$numrand.$type;
			$path_copy = $path.$newname;
			$path_link="img-member/".$newname;
			move_uploaded_file($_FILES['m_img']['tmp_name'],$path_copy);  	
		}
		
		$sqla2 = "INSERT INTO tb_member(m_username, m_password, m_prefix, m_fname, m_lname, m_idcard, m_tel, m_idline, m_email, m_img, pos_id, m_status, m_save) 
		VALUES('$m_username', '$m_password', '$m_prefix', '$m_fname', '$m_lname', '$m_idcard', '$m_tel', '$m_idline', '$m_email', '$newname', '$pos_id', '$m_status', '$m_save')";
		$querya2 = mysqli_query($conn, $sqla2);
		if($querya2){
			echo '
				<script>
					swal({
						title: "บันทึกข้อมูลสำเร็จ", 
						text: "กรุณากด ตกลง เพื่อดำเนินการต่อไป",
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
						title: "Error บันทึกข้อมูลไม่สำเร็จ", 
						text: "กรุณากด ตกลง เพื่อดำเนินการต่อไป",
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