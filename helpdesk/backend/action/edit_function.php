<?php
include_once(__DIR__ . '/repair_tracking_helper.php');

if (!function_exists('showEditAlert')) {
	function showEditAlert($title, $icon, $redirect, $text = null, $autoClose = false, $extraConfig = '')
	{
		$textLine = $text !== null ? 'text: "'.addslashes($text).'",' : '';
		$buttonLine = $autoClose ? 'button: false,' : 'button: "ตกลง",';
		$timerLines = $autoClose ? "\n\t\t\t\t\t\ttimer: 1200,\n\t\t\t\t\t\tcloseOnClickOutside: false,\n\t\t\t\t\t\tcloseOnEsc: false," : '';
		$extraLine = $extraConfig !== '' ? "\n\t\t\t\t\t\t" . $extraConfig : '';

		echo '
			<script>
				swal({
					title: "'.addslashes($title).'",
					'.$textLine.'
					icon: "'.$icon.'",
					'.$buttonLine.$timerLines.$extraLine.'
				}).then(() => {
					location.href = "'.$redirect.'"
				});
			</script>
		';
	}
}

if (isset($_POST['btnEditPosition'])) {
	$p_id = $_POST['p_id'];
	$p_position = $_POST['p_position'];
	$query = mysqli_query($conn, "UPDATE tb_position SET p_position = '" . repairEscape($conn, $p_position) . "' WHERE p_id = '" . repairEscape($conn, $p_id) . "'");
	showEditAlert($query ? 'แก้ไขข้อมูลสำเร็จ' : 'แก้ไขข้อมูลไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnEditDepartment'])) {
	$dep_id = $_POST['dep_id'];
	$dep_name = $_POST['dep_name'];
	$query = mysqli_query($conn, "UPDATE tb_department SET dep_name = '" . repairEscape($conn, $dep_name) . "' WHERE dep_id = '" . repairEscape($conn, $dep_id) . "'");
	showEditAlert($query ? 'แก้ไขข้อมูลสำเร็จ' : 'แก้ไขข้อมูลไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnEditEquipment'])) {
	$eq_id = $_POST['eq_id'];
	$eq_name = $_POST['eq_name'];
	$query = mysqli_query($conn, "UPDATE tb_equipment SET eq_name = '" . repairEscape($conn, $eq_name) . "' WHERE eq_id = '" . repairEscape($conn, $eq_id) . "'");
	showEditAlert($query ? 'แก้ไขข้อมูลสำเร็จ' : 'แก้ไขข้อมูลไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnEditBuilding'])) {
	$build_id = $_POST['build_id'];
	$build_name = $_POST['build_name'];
	$query = mysqli_query($conn, "UPDATE tb_building SET build_name = '" . repairEscape($conn, $build_name) . "' WHERE build_id = '" . repairEscape($conn, $build_id) . "'");
	showEditAlert($query ? 'แก้ไขข้อมูลสำเร็จ' : 'แก้ไขข้อมูลไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnCancelUser'])) {
	$u_idcard = $_POST['u_idcard'];
	$query = mysqli_query($conn, "UPDATE tb_user SET u_status = '0' WHERE u_idcard = '" . repairEscape($conn, $u_idcard) . "'");
	showEditAlert($query ? 'ปิดการใช้งานสำเร็จ' : 'ปิดการใช้งานไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnCancelUserOn'])) {
	$u_idcard = $_POST['u_idcard'];
	$query = mysqli_query($conn, "UPDATE tb_user SET u_status = '1' WHERE u_idcard = '" . repairEscape($conn, $u_idcard) . "'");
	showEditAlert($query ? 'เปิดการใช้งานสำเร็จ' : 'เปิดการใช้งานไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnSent'])) {
	$r_no = $_POST['r_no'];
	$s_id = $_POST['s_id'];
	$currentRepair = repairGetCurrentRepairRow($conn, $r_no);
	$old_s_id = $currentRepair ? $currentRepair['s_id'] : null;
	$technician_id = $currentRepair ? $currentRepair['technician_id'] : $record['u_idcard'];
	$statusName = repairGetStatusName($conn, $s_id);
	$updateParts = ["s_id = '" . repairEscape($conn, $s_id) . "'"];

	if ($s_id === '3') {
		$updateParts[] = "accepted_at = COALESCE(accepted_at, NOW())";
		$updateParts[] = "started_at = COALESCE(started_at, NOW())";
	}
	if ($s_id === '4') {
		$updateParts[] = "accepted_at = COALESCE(accepted_at, NOW())";
		$updateParts[] = "started_at = COALESCE(started_at, NOW())";
		$updateParts[] = "completed_at = COALESCE(completed_at, NOW())";
		$updateParts[] = "closed_at = COALESCE(closed_at, NOW())";
	}

	$sql = "UPDATE tb_repair SET " . implode(', ', $updateParts) . " WHERE r_no = '" . repairEscape($conn, $r_no) . "'";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		$action_type = 'status_update';
		$log_note = 'อัปเดตสถานะเป็น ' . $statusName;
		include(__DIR__ . '/../function_get_system.php');
		repairInsertComment($conn, $r_no, $record['u_idcard'], $log_note, 'status');
		if ($currentRepair) {
			repairInsertNotification($conn, $currentRepair['u_idcard'], $r_no, 'สถานะงานซ่อมมีการเปลี่ยนแปลง', $log_note);
		}
		showEditAlert('อัปเดตสถานะสำเร็จ', 'success', $_SERVER['REQUEST_URI'], null, true);
	} else {
		showEditAlert('อัปเดตสถานะไม่สำเร็จ', 'error', $_SERVER['REQUEST_URI'], 'กรุณาทำรายการใหม่อีกครั้ง');
	}
}

if (isset($_POST['btnApprove'])) {
	$r_no = $_POST['r_no'];
	$technician_id = $_POST['technician_id'];
	$head_id = $_POST['head_id'];
	$s_id = '2';
	$currentRepair = repairGetCurrentRepairRow($conn, $r_no);
	$old_s_id = $currentRepair ? $currentRepair['s_id'] : null;
	$fromTechnician = $currentRepair ? $currentRepair['technician_id'] : null;

	$sql = "UPDATE tb_repair SET
				s_id = '2',
				technician_id = '" . repairEscape($conn, $technician_id) . "',
				head_id = '" . repairEscape($conn, $head_id) . "'
			WHERE r_no = '" . repairEscape($conn, $r_no) . "'";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		$action_type = 'assign';
		$log_note = 'มอบหมายงานให้ช่างผู้รับผิดชอบ';
		include(__DIR__ . '/../function_get_system.php');
		repairInsertAssignmentHistory($conn, $r_no, $fromTechnician, $technician_id, $head_id, 'มอบหมายงานซ่อม');
		repairInsertComment($conn, $r_no, $head_id, 'มอบหมายงานให้ช่างเรียบร้อยแล้ว', 'assignment');
		repairInsertNotification($conn, $technician_id, $r_no, 'คุณได้รับมอบหมายงานซ่อม', 'มีการมอบหมายงานเลขที่ ' . $r_no . ' ให้คุณดำเนินการ');
		showEditAlert('มอบหมายงานสำเร็จ', 'success', $_SERVER['REQUEST_URI'], null, true);
	} else {
		showEditAlert('มอบหมายงานไม่สำเร็จ', 'error', $_SERVER['REQUEST_URI'], 'กรุณาทำรายการใหม่อีกครั้ง');
	}
}

if (isset($_POST['btnEditProfile'])) {
	$u_prefix = $_POST['u_prefix'];
	$u_idcard = $_POST['u_idcard'];
	$u_fname = $_POST['u_fname'];
	$u_lname = $_POST['u_lname'];
	$u_mobile = $_POST['u_mobile'];
	$u_email = $_POST['u_email'];

	$sql = "UPDATE tb_user SET
				u_prefix = '" . repairEscape($conn, $u_prefix) . "',
				u_fname = '" . repairEscape($conn, $u_fname) . "',
				u_lname = '" . repairEscape($conn, $u_lname) . "',
				u_mobile = '" . repairEscape($conn, $u_mobile) . "',
				u_email = '" . repairEscape($conn, $u_email) . "'
			WHERE u_idcard = '" . repairEscape($conn, $u_idcard) . "'";
	$query = mysqli_query($conn, $sql);
	showEditAlert($query ? 'แก้ไขข้อมูลสำเร็จ' : 'แก้ไขข้อมูลไม่สำเร็จ', $query ? 'success' : 'error', $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
}

if (isset($_POST['btnResetPassword'])) {
	$u_idcard = $_POST['u_idcard'];
	$u_password1 = $_POST['u_password1'];
	$u_password2 = $_POST['u_password2'];

	if ($u_password1 === $u_password2) {
		$u_password = md5($u_password2);
		$query = mysqli_query($conn, "UPDATE tb_user SET u_password = '" . repairEscape($conn, $u_password) . "' WHERE u_idcard = '" . repairEscape($conn, $u_idcard) . "'");
		showEditAlert($query ? 'เปลี่ยนรหัสผ่านสำเร็จ' : 'เปลี่ยนรหัสผ่านไม่สำเร็จ', $query ? 'success' : 'error', $query ? 'logout.php' : $_SERVER['REQUEST_URI'], $query ? null : 'กรุณาทำรายการใหม่อีกครั้ง', $query);
	} else {
		showEditAlert('ไม่สามารถเปลี่ยนรหัสผ่านได้', 'info', $_SERVER['REQUEST_URI'], 'เนื่องจากรหัสผ่านที่ป้อนไม่ตรงกัน', false, 'dangerMode: true,');
		exit();
	}
}
?>
