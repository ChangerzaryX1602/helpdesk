<?php
session_start();
include('../config/connect.php');
include('type_user.php');

if(!in_array($_SESSION['level_id'], array('01','02','04'))) {
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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include('import_style.php'); ?>
  <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300&amp;subset=thai" rel="stylesheet">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include('header.php'); ?>
  <?php include('menu_left.php'); ?>

  <div class="content-wrapper">
    <?php include('menu_main.php'); ?>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form name="form_equipment_registry" method="post" action="action/action_update_equipment_registry.php">
            <input type="hidden" name="reg_id" value="<?php echo $rows['reg_id']; ?>">
            <div class="box">
              <div class="box-header text-center bg-blue">
                <h3 class="box-title"><i class="fa fa-database" style="margin-right:7px;"></i>แก้ไขทะเบียนอุปกรณ์</h3>
              </div>
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>หน่วยงาน</label>
                      <select name="dep_id" class="form-control" required>
                        <option value="">เลือกหน่วยงาน</option>
                        <?php
                        $depQuery = mysqli_query($conn, "SELECT * FROM tb_department ORDER BY dep_id ASC");
                        while ($dep = mysqli_fetch_array($depQuery)) {
                        ?>
                          <option value="<?php echo $dep['dep_id']; ?>" <?php if($rows['dep_id'] == $dep['dep_id']) echo 'selected'; ?>><?php echo htmlspecialchars($dep['dep_name']); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>ประเภทครุภัณฑ์</label>
                      <div style="display:flex;flex-wrap:wrap;gap:8px 24px;padding-top:6px;">
                        <?php
                        $eqQuery = mysqli_query($conn, "SELECT * FROM tb_equipment ORDER BY eq_id ASC");
                        while ($eq = mysqli_fetch_array($eqQuery)) {
                        ?>
                          <label style="font-weight:normal;cursor:pointer;margin:0;display:inline-flex;align-items:center;">
                            <input type="radio" name="eq_id" value="<?php echo $eq['eq_id']; ?>" <?php if($rows['eq_id'] == $eq['eq_id']) echo 'checked'; ?> required style="margin:0 6px 0 0;vertical-align:middle;">
                            <span><?php echo htmlspecialchars($eq['eq_name']); ?></span>
                          </label>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>ยี่ห้อ/รุ่น</label>
                      <input type="text" name="reg_brand_model" class="form-control" value="<?php echo htmlspecialchars($rows['reg_brand_model']); ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>เลขครุภัณฑ์</label>
                      <div style="display:flex;align-items:center;gap:6px;">
                        <input type="text" name="com_num1" class="form-control" maxlength="50" placeholder="ส่วนหน้า" value="<?php echo htmlspecialchars($rows['com_num1']); ?>" required>
                        <span style="font-weight:500;color:#666;">-</span>
                        <input type="text" name="com_num2" class="form-control" maxlength="20" placeholder="ส่วนหลัง" value="<?php echo htmlspecialchars($rows['com_num2']); ?>" style="max-width:140px;">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Computer Name</label>
                      <input type="text" name="reg_computer_name" class="form-control" value="<?php echo htmlspecialchars($rows['reg_computer_name']); ?>">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>ชื่อผู้ใช้งาน</label>
                      <input type="text" name="reg_user_name" class="form-control" value="<?php echo htmlspecialchars($rows['reg_user_name']); ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>CPU</label>
                      <input type="text" name="reg_cpu" class="form-control" value="<?php echo htmlspecialchars($rows['reg_cpu']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Ram</label>
                      <input type="text" name="reg_ram" class="form-control" value="<?php echo htmlspecialchars($rows['reg_ram']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label>Hard Disk</label>
                      <input type="text" name="reg_harddisk" class="form-control" value="<?php echo htmlspecialchars($rows['reg_harddisk']); ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Monitor</label>
                      <input type="text" name="reg_monitor" class="form-control" value="<?php echo htmlspecialchars($rows['reg_monitor']); ?>">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>OS</label>
                      <input type="text" name="reg_os" class="form-control" value="<?php echo htmlspecialchars($rows['reg_os']); ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Ip Address</label>
                      <input type="text" name="reg_ip" class="form-control" value="<?php echo htmlspecialchars($rows['reg_ip']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Subnet Mask</label>
                      <input type="text" name="reg_subnet" class="form-control" value="<?php echo htmlspecialchars($rows['reg_subnet']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label>Gateway</label>
                      <input type="text" name="reg_gateway" class="form-control" value="<?php echo htmlspecialchars($rows['reg_gateway']); ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Device Peripherals</label>
                      <input type="text" name="reg_peripherals" class="form-control" value="<?php echo htmlspecialchars($rows['reg_peripherals']); ?>">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>Switch/Port</label>
                      <input type="text" name="reg_switch_port" class="form-control" value="<?php echo htmlspecialchars($rows['reg_switch_port']); ?>">
                    </div>
                  </div>
                </div>

              </div>

              <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                <a href="list_equipment_registry.php" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-reply"></i> กลับหน้ารายการ</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>

<?php include('import_script.php'); ?>
</body>
</html>
<?php mysqli_close($conn); ?>
