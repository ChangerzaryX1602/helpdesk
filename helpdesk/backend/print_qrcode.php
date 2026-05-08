<?php
session_start();
include('../config/connect.php');

if(!in_array($_SESSION['level_id'] ?? '', array('01','02','04'))) {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location='dashboard.php';</script>";
    exit();
}

$reg_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$sql = "SELECT * FROM tb_equipment_registry WHERE reg_id = $reg_id";
$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_array($query);

if (!$rows) {
    echo "<script>alert('ไม่พบข้อมูลทะเบียนอุปกรณ์'); window.location='list_equipment_registry.php';</script>";
    exit();
}

$com1 = trim((string)$rows['com_num1']);
$device_id = htmlspecialchars($com1);
$device_ip = htmlspecialchars($rows['reg_ip']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>พิมพ์ QR Code อุปกรณ์</title>
<link href="https://fonts.googleapis.com/css?family=Kanit:300,400,500&subset=thai" rel="stylesheet">
<style>
    @page {
        size: 62mm 62mm;
        margin: 0;
    }
    html, body {
        margin: 0;
        padding: 0;
        font-family: 'Kanit', sans-serif;
        background: #f0f0f0;
    }
    .label {
        width: 62mm;
        height: 62mm;
        box-sizing: border-box;
        padding: 2mm 2mm;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        margin: 20px auto;
        box-shadow: 0 0 6px rgba(0,0,0,0.15);
    }
    .header {
        font-size: 11pt;
        font-weight: 500;
        text-align: center;
        line-height: 1.1;
        margin-top: 1mm;
    }
    .qr {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    .qr img {
        width: 42mm;
        height: 42mm;
        display: block;
    }
    .footer {
        font-size: 10pt;
        text-align: center;
        font-weight: 400;
        margin-bottom: 1mm;
        white-space: nowrap;
    }
    .toolbar {
        text-align: center;
        margin: 16px 0;
    }
    .toolbar button, .toolbar a {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        padding: 8px 18px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        margin: 0 4px;
        text-decoration: none;
        color: #fff;
    }
    .btn-print { background: #1e88e5; }
    .btn-back  { background: #757575; }
    @media print {
        body { background: #ffffff; }
        .label {
            margin: 0;
            box-shadow: none;
            page-break-after: always;
        }
        .toolbar { display: none; }
    }
</style>
</head>
<body>

<div class="toolbar">
    <button type="button" class="btn-print" onclick="window.print()"><i></i> พิมพ์</button>
    <a href="list_equipment_registry.php" class="btn-back">กลับ</a>
</div>

<div class="label">
    <div class="header">สำนักงานเทศบาลนครขอนแก่น</div>
    <div class="qr">
        <img src="assets/img/qrcode_equipment.jpeg" alt="QR Code">
    </div>
    <div class="footer">ID:<?php echo $device_id; ?> &nbsp; IP : <?php echo $device_ip; ?></div>
</div>

<script>
    window.addEventListener('load', function() {
        setTimeout(function() { window.print(); }, 300);
    });
</script>
</body>
</html>
<?php mysqli_close($conn); ?>
