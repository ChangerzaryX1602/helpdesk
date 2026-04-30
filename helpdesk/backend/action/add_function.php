<?php

if (!function_exists('showAddAlert')) {
	function showAddAlert($title, $icon, $redirect, $text = null, $autoClose = false)
	{
		$textLine = $text !== null ? 'text: "'.$text.'",' : '';
		$buttonLine = $autoClose ? 'button: false,' : 'button: "ตกลง",';
		$timerLines = $autoClose ? "\n\t\t\t\t\t\ttimer: 1200,\n\t\t\t\t\t\tcloseOnClickOutside: false,\n\t\t\t\t\t\tcloseOnEsc: false," : '';

		echo '
			<script>
				swal({
					title: "'.$title.'",
					'.$textLine.'
					icon: "'.$icon.'",
					'.$buttonLine.$timerLines.'
				}).then(() => {
					location.href = "'.$redirect.'"
				});
			</script>
		';
	}
}

// เพิ่ม Position
if (isset($_POST['btnAddPosition'])) {
	$sqlcheck = "SELECT p_id FROM tb_position ORDER BY p_id DESC LIMIT 1";
	$querycheck = mysqli_query($conn, $sqlcheck);
	$numrow = mysqli_fetch_array($querycheck);
	$p_id = $numrow['p_id'] + 1;
	$p_position = $_POST['p_position'];

	$sqla1 = "INSERT INTO tb_position(p_id, p_position) VALUES($p_id, '$p_position')";
	$querya1 = mysqli_query($conn, $sqla1);

	if ($querya1) {
		showAddAlert("บันทึกข้อมูลสำเร็จ", "success", $_SERVER['REQUEST_URI'], null, true);
	} else {
		showAddAlert("เกิดข้อผิดพลาด", "error", $_SERVER['REQUEST_URI'], "กรุณาทำรายการใหม่อีกครั้ง");
	}
}

// เพิ่ม Department
if (isset($_POST['btnAddDepartment'])) {
	$sqlcheck = "SELECT dep_id FROM tb_department ORDER BY dep_id DESC LIMIT 1";
	$querycheck = mysqli_query($conn, $sqlcheck);
	$numrow = mysqli_fetch_array($querycheck);
	$dep_id = $numrow['dep_id'] + 1;
	$dep_name = $_POST['dep_name'];

	$sqla2 = "INSERT INTO tb_department(dep_id, dep_name) VALUES($dep_id, '$dep_name')";
	$querya2 = mysqli_query($conn, $sqla2);

	if ($querya2) {
		showAddAlert("บันทึกข้อมูลสำเร็จ", "success", $_SERVER['REQUEST_URI'], null, true);
	} else {
		showAddAlert("เกิดข้อผิดพลาด", "error", $_SERVER['REQUEST_URI'], "กรุณาทำรายการใหม่อีกครั้ง");
	}
}

// เพิ่ม Equipment
if (isset($_POST['btnAddEquipment'])) {
	$sqlcheck = "SELECT eq_id FROM tb_equipment ORDER BY eq_id DESC LIMIT 1";
	$querycheck = mysqli_query($conn, $sqlcheck);
	$numrow = mysqli_fetch_array($querycheck);
	$eq_id = $numrow['eq_id'] + 1;
	$eq_name = $_POST['eq_name'];

	$sqla3 = "INSERT INTO tb_equipment(eq_id, eq_name) VALUES($eq_id, '$eq_name')";
	$querya3 = mysqli_query($conn, $sqla3);

	if ($querya3) {
		showAddAlert("บันทึกข้อมูลสำเร็จ", "success", $_SERVER['REQUEST_URI'], null, true);
	} else {
		showAddAlert("เกิดข้อผิดพลาด", "error", $_SERVER['REQUEST_URI'], "กรุณาทำรายการใหม่อีกครั้ง");
	}
}

// เพิ่ม Building
if (isset($_POST['btnAddBuilding'])) {
	$sqlcheck = "SELECT build_id FROM tb_building ORDER BY build_id DESC LIMIT 1";
	$querycheck = mysqli_query($conn, $sqlcheck);
	$numrow = mysqli_fetch_array($querycheck);
	$build_id = $numrow['build_id'] + 1;
	$build_name = $_POST['build_name'];

	$sqla4 = "INSERT INTO tb_building(build_id, build_name) VALUES($build_id, '$build_name')";
	$querya4 = mysqli_query($conn, $sqla4);

	if ($querya4) {
		showAddAlert("บันทึกข้อมูลสำเร็จ", "success", $_SERVER['REQUEST_URI'], null, true);
	} else {
		showAddAlert("เกิดข้อผิดพลาด", "error", $_SERVER['REQUEST_URI'], "กรุณาทำรายการใหม่อีกครั้ง");
	}
}
?>
