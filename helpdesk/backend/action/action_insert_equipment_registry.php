<?php
session_start();
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
$dep_id          = (int) $_POST['dep_id'];
$eq_id           = (int) $_POST['eq_id'];
$brand_model     = mysqli_real_escape_string($conn, trim($_POST['reg_brand_model']));
$asset_no        = mysqli_real_escape_string($conn, trim($_POST['reg_asset_no']));
$computer_name   = mysqli_real_escape_string($conn, trim($_POST['reg_computer_name']));
$user_name       = mysqli_real_escape_string($conn, trim($_POST['reg_user_name']));
$cpu             = mysqli_real_escape_string($conn, trim($_POST['reg_cpu']));
$ram             = mysqli_real_escape_string($conn, trim($_POST['reg_ram']));
$harddisk        = mysqli_real_escape_string($conn, trim($_POST['reg_harddisk']));
$monitor         = mysqli_real_escape_string($conn, trim($_POST['reg_monitor']));
$os              = mysqli_real_escape_string($conn, trim($_POST['reg_os']));
$ip              = mysqli_real_escape_string($conn, trim($_POST['reg_ip']));
$subnet          = mysqli_real_escape_string($conn, trim($_POST['reg_subnet']));
$gateway         = mysqli_real_escape_string($conn, trim($_POST['reg_gateway']));
$peripherals     = mysqli_real_escape_string($conn, trim($_POST['reg_peripherals']));
$switch_port     = mysqli_real_escape_string($conn, trim($_POST['reg_switch_port']));
$reg_save        = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_equipment_registry (
			dep_id, eq_id, reg_brand_model, reg_asset_no, reg_computer_name,
			reg_user_name, reg_cpu, reg_ram, reg_harddisk, reg_monitor, reg_os,
			reg_ip, reg_subnet, reg_gateway, reg_peripherals, reg_switch_port, reg_save
		) VALUES (
			$dep_id, $eq_id, '$brand_model', '$asset_no', '$computer_name',
			'$user_name', '$cpu', '$ram', '$harddisk', '$monitor', '$os',
			'$ip', '$subnet', '$gateway', '$peripherals', '$switch_port', '$reg_save'
		)";
$query = mysqli_query($conn, $sql);

if ($query) {
	echo '
		<script>
			swal({
				title: "บันทึกข้อมูลทะเบียนอุปกรณ์สำเร็จ",
				icon: "success",
				button: false,
				timer: 1200,
				closeOnClickOutside: false,
				closeOnEsc: false,
			}).then(() => {
				location.href = "../list_equipment_registry.php"
			});
		</script>
	';
} else {
	echo '
		<script>
			swal({
				title: "เกิดข้อผิดพลาด",
				text: "ไม่สามารถบันทึกข้อมูลทะเบียนอุปกรณ์ได้",
				icon: "error",
				button: "ตกลง",
			}).then(() => {
				history.back()
			});
		</script>
	';
}

mysqli_close($conn);
?>
</div>
</body>
</html>
