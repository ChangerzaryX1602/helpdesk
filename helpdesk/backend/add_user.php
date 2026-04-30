<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include('import_style.php');?>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300&amp;subset=thai" rel="stylesheet">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include('header.php');?>
  
  <?php include('menu_left.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php
    	include('menu_main.php');
	?>

    <!-- Main content -->
    <section class="content">
	<!--เนื้อหา-->

<div class="row">
		<div class="col-md-12">
          <form name="form_user" method="post" action="action/action_insert_user.php">
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-user-plus" style="margin-right:7px;"></i>เพิ่มข้อมูลผู้ใช้งานระบบ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              					<div class="row">
                                    <div class="col-md-3 pr-md-1">
                                      <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="u_username" class="form-control" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-3 pr-md-1">
                                      <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="u_password" class="form-control" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>คำนำหน้า</label>
                                        <input type="text" name="u_prefix" class="form-control" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-5 pr-md-1">
                                      <div class="form-group">
                                        <label>ชื่อ</label>
                                        <input type="text" name="u_fname" class="form-control" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-5 pl-md-1">
                                      <div class="form-group">
                                        <label>นามสกุล</label>
                                        <input type="text" name="u_lname" class="form-control" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>บัตรประชาชน</label>
                                        <input type="text" name="u_idcard" class="form-control" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>เบอร์โทรศัพท์มือถือ</label>
                                        <input type="text" name="u_mobile" class="form-control" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>เบอร์ภายใน</label>
                                        <input type="text" name="u_tel" class="form-control" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-4 pr-md-1">
                                      <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="u_email" class="form-control" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                      <div class="form-group">
                                        <label>ตำแหน่ง</label>
                                        <select name="p_id" class="form-control" required="">
                                        	<option value="">เลือกตำแหน่ง</option>
                                        	<?php
                                            	$sql = "SELECT * FROM tb_position ORDER BY p_id ASC";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query)) {
											?>
                                        	<option value="<?php echo $row['p_id'];?>"><?php echo $row['p_position'];?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4 pr-md-1">
                                      <div class="form-group">
                                        <label>แผนก</label>
                                        <select name="dep_id" class="form-control" required="">
                                        	<option value="">เลือกแผนก</option>
                                        	<?php
                                            	$sql = "SELECT * FROM tb_department ORDER BY dep_id ASC";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query)) {
											?>
                                        	<option value="<?php echo $row['dep_id'];?>"><?php echo $row['dep_name'];?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-3 pl-md-1">
                                      <div class="form-group">
                                        <label>สิทธิ์การใช้งาน</label>
                                        <select name="level_id" class="form-control" required="">
                                        	<option value="">เลือกสิทธิ์การใช้งาน</option>
                                        	<?php
                                            	$sql = "SELECT * FROM tb_user_level ORDER BY level_id ASC";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query)) {
											?>
                                        	<option value="<?php echo $row['level_id'];?>"><?php echo $row['level_name'];?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
          	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
          	<button type="reset" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-undo"></i> ล้างข้อมูล</button>
          </div>
          <!-- /.box -->
          </form>
        </div>
        <!-- /.col -->
</div> <!-- ./row-->

    <!--ปิดเนื้อหา-->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
  
  <?php include('footer.php');?>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

	<?php include('import_script.php');?>
</body>
</html>
<?php
  mysqli_close($conn);
?>