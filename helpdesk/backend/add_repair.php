<?php
session_start();
include('../config/connect.php');
include('type_user.php');
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
          <form name="form_repair" method="post" action="action/action_insert_repair.php">
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>ผู้แจ้งซ่อม</label>
                      <input type="text" class="form-control" value="<?php echo $record['u_prefix'] . $record['u_fname'] . ' ' . $record['u_lname']; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>ประเภทอุปกรณ์</label>
                      <select name="eq_id" class="form-control" required>
                        <option value="">เลือกประเภทอุปกรณ์</option>
                        <?php
                        $equipmentQuery = mysqli_query($conn, "SELECT * FROM tb_equipment ORDER BY eq_id ASC");
                        while ($equipment = mysqli_fetch_array($equipmentQuery)) {
                        ?>
                          <option value="<?php echo $equipment['eq_id']; ?>"><?php echo $equipment['eq_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>ชื่ออุปกรณ์</label>
                      <input type="text" name="r_name" class="form-control" placeholder="เช่น Macbook Pro 2020" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>หมายเลขเครื่อง</label>
                      <input type="text" name="r_serialnumber" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>อาการ / รายละเอียดปัญหา</label>
                      <textarea name="r_detail" class="form-control" rows="4" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>ระดับความสำคัญ</label>
                      <select name="wl_id" class="form-control" required>
                        <option value="1">ปกติ</option>
                        <option value="2">ปานกลาง</option>
                        <option value="3">เร่งด่วน</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>อาคาร / ตึก</label>
                      <select name="build_id" class="form-control" required>
                        <option value="">เลือกอาคาร / ตึก</option>
                        <?php
                        $buildingQuery = mysqli_query($conn, "SELECT * FROM tb_building ORDER BY build_id ASC");
                        while ($building = mysqli_fetch_array($buildingQuery)) {
                        ?>
                          <option value="<?php echo $building['build_id']; ?>"><?php echo $building['build_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ชั้น</label>
                      <input type="text" name="floor" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>ห้อง</label>
                      <input type="text" name="room" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
                <input type="hidden" name="u_idcard" value="<?php echo $record['u_idcard']; ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-undo"></i> ล้างข้อมูล</button>
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
