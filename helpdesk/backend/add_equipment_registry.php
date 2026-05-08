<?php
session_start();
include('../config/connect.php');
include('type_user.php');

if(!in_array($_SESSION['level_id'], array('01','02','04'))) {
	echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location='dashboard.php';</script>";
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
          <form name="form_equipment_registry" method="post" action="action/action_insert_equipment_registry.php">
            <div class="box">
              <div class="box-header text-center bg-blue">
                <h3 class="box-title"><i class="fa fa-database" style="margin-right:7px;"></i>ลงทะเบียนอุปกรณ์</h3>
              </div>
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>หน่วยงาน</label>
                      <select name="dep_id" id="dep_id" class="form-control" required>
                        <option value="">เลือกหน่วยงาน</option>
                        <?php
                        $depQuery = mysqli_query($conn, "SELECT * FROM tb_department ORDER BY dep_id ASC");
                        while ($dep = mysqli_fetch_array($depQuery)) {
                        ?>
                          <option value="<?php echo $dep['dep_id']; ?>"><?php echo htmlspecialchars($dep['dep_name']); ?></option>
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
                            <input type="radio" name="eq_id" value="<?php echo $eq['eq_id']; ?>" required style="margin:0 6px 0 0;vertical-align:middle;">
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
                      <input type="text" name="reg_brand_model" class="form-control" placeholder="เช่น HP ProBook 450 G8" required>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>เลขครุภัณฑ์</label>
                      <div style="display:flex;align-items:center;gap:6px;">
                        <input type="text" name="com_num1" id="com_num1" class="form-control" maxlength="50" placeholder="ส่วนหน้า" required>
                        <span style="font-weight:500;color:#666;">-</span>
                        <input type="text" name="com_num2" class="form-control" maxlength="20" placeholder="ส่วนหลัง" style="max-width:140px;">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Computer Name</label>
                      <input type="text" name="reg_computer_name" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>ชื่อผู้ใช้งาน</label>
                      <input type="text" name="reg_user_name" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>CPU</label>
                      <input type="text" name="reg_cpu" class="form-control" placeholder="เช่น Intel Core i5-1135G7">
                    </div>
                  </div>
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Ram</label>
                      <input type="text" name="reg_ram" class="form-control" placeholder="เช่น 8GB DDR4">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label>Hard Disk</label>
                      <input type="text" name="reg_harddisk" class="form-control" placeholder="เช่น SSD 512GB">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Monitor</label>
                      <input type="text" name="reg_monitor" class="form-control" placeholder="เช่น Dell 24'' P2419H">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>OS</label>
                      <input type="text" name="reg_os" class="form-control" placeholder="เช่น Windows 11 Pro">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Ip Address</label>
                      <input type="text" name="reg_ip" class="form-control" placeholder="192.168.1.100">
                    </div>
                  </div>
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Subnet Mask</label>
                      <input type="text" name="reg_subnet" class="form-control" placeholder="255.255.255.0">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label>Gateway</label>
                      <input type="text" name="reg_gateway" class="form-control" placeholder="192.168.1.1">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>Device Peripherals</label>
                      <input type="text" name="reg_peripherals" class="form-control" placeholder="เช่น Mouse, Keyboard, Webcam">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>Switch/Port</label>
                      <input type="text" name="reg_switch_port" class="form-control" placeholder="เช่น SW-01 / Port 12">
                    </div>
                  </div>
                </div>

              </div>

              <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-undo"></i> ล้างข้อมูล</button>
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
<script>
$(function () {
    function fetchNextComNum() {
        var depId = $('#dep_id').val();
        if (!depId) return;
        $.getJSON('action/get_next_com_num.php', { dep_id: depId }, function (data) {
            if (data && data.next) {
                $('#com_num1').val(data.next);
            }
        });
    }
    $('#dep_id').on('change', fetchNextComNum);
    fetchNextComNum();
});
</script>
</body>
</html>
<?php mysqli_close($conn); ?>
