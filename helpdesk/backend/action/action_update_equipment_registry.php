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
$reg_id          = (int) $_POST['reg_id'];
$dep_id          = (int) $_POST['dep_id'];
$eq_id           = (int) $_POST['eq_id'];
$brand_model     = mysqli_real_escape_string($conn, trim($_POST['reg_brand_model']));
$com_num1        = mysqli_real_escape_string($conn, trim($_POST['com_num1']));
$com_num2        = mysqli_real_escape_string($conn, trim($_POST['com_num2']));
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

$com_num2_val = ($com_num2 === '') ? "NULL" : "'$com_num2'";

$sql = "UPDATE tb_equipment_registry SET
			dep_id = $dep_id,
			eq_id = $eq_id,
			reg_brand_model = '$brand_model',
			com_num1 = '$com_num1',
			com_num2 = $com_num2_val,
			reg_computer_name = '$computer_name',
			reg_user_name = '$user_name',
			reg_cpu = '$cpu',
			reg_ram = '$ram',
			reg_harddisk = '$harddisk',
			reg_monitor = '$monitor',
			reg_os = '$os',
			reg_ip = '$ip',
			reg_subnet = '$subnet',
			reg_gateway = '$gateway',
			reg_peripherals = '$peripherals',
			reg_switch_port = '$switch_port'
		WHERE reg_id = $reg_id";
$query = mysqli_query($conn, $sql);

if ($query) {
	echo '
		<script>
			swal({
				title: "แก้ไขข้อมูลทะเบียนอุปกรณ์สำเร็จ",
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
				text: "ไม่สามารถแก้ไขข้อมูลทะเบียนอุปกรณ์ได้",
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
