<?php session_start();
	include('../config/connect.php');
	include('type_user.php');

	$u_idcard = $_GET['u_idcard'];
	$sql = "SELECT u.*, l.level_name, dep.dep_name, p.p_position
	FROM tb_user AS u
	INNER JOIN tb_user_level AS l ON u.level_id = l.level_id
	INNER JOIN tb_department AS dep ON u.dep_id = dep.dep_id
	INNER JOIN tb_position AS p ON u.p_id = p.p_id
	WHERE u.u_idcard = '$u_idcard'";
	$query = mysqli_query($conn, $sql);
	$rows = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include('import_style.php');?>

  <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300&amp;subset=thai" rel="stylesheet">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include('header.php');?>
  <?php include('menu_left.php');?>

  <div class="content-wrapper">
    <?php include('menu_main.php');?>

    <section class="content">
<div class="row">
		<div class="col-md-12">
          <form name="form_user" method="post" action="action/action_update_user.php">
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-user-circle-o" style="margin-right:7px;"></i>แก้ไขข้อมูลผู้ใช้งาน</h3>
            </div>
            <div class="box-body">
              					<div class="row">
                                    <div class="col-md-3 pr-md-1">
                                      <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?php echo $rows['u_username'];?>" disabled="disabled">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>คำนำหน้า</label>
                                        <input type="text" name="u_prefix" class="form-control" value="<?php echo $rows['u_prefix'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-5 pr-md-1">
                                      <div class="form-group">
                                        <label>ชื่อ</label>
                                        <input type="text" name="u_fname" class="form-control" value="<?php echo $rows['u_fname'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-5 pl-md-1">
                                      <div class="form-group">
                                        <label>นามสกุล</label>
                                        <input type="text" name="u_lname" class="form-control" value="<?php echo $rows['u_lname'];?>" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>บัตรประชาชน</label>
                                        <input type="text" class="form-control" value="<?php echo $rows['u_idcard'];?>" disabled="disabled">
                                      </div>
                                    </div>
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>เบอร์โทรศัพท์มือถือ</label>
                                        <input type="text" name="u_mobile" class="form-control" value="<?php echo $rows['u_mobile'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-2 pr-md-1">
                                      <div class="form-group">
                                        <label>เบอร์ภายใน</label>
                                        <input type="text" name="u_tel" class="form-control" value="<?php echo $rows['u_tel'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-4 pr-md-1">
                                      <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="u_email" class="form-control" value="<?php echo $rows['u_email'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-2 pl-md-1">
                                      <div class="form-group">
                                        <label>วันที่ลงทะเบียน</label>
                                        <input type="text" class="form-control" value="<?php echo $rows['u_save'];?>" disabled="disabled">
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
                                            	$sql_position = "SELECT * FROM tb_position ORDER BY p_id ASC";
												$query_position = mysqli_query($conn, $sql_position);
												while($row_position = mysqli_fetch_array($query_position)) {
											?>
                                        	<option value="<?php echo $row_position['p_id'];?>" <?php if($rows['p_id'] == $row_position['p_id']) echo 'selected'; ?>>
												<?php echo $row_position['p_position'];?>
											</option>
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
                                            	$sql_department = "SELECT * FROM tb_department ORDER BY dep_id ASC";
												$query_department = mysqli_query($conn, $sql_department);
												while($row_department = mysqli_fetch_array($query_department)) {
											?>
                                        	<option value="<?php echo $row_department['dep_id'];?>" <?php if($rows['dep_id'] == $row_department['dep_id']) echo 'selected'; ?>>
												<?php echo $row_department['dep_name'];?>
											</option>
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
                                            	$sql_level = "SELECT * FROM tb_user_level ORDER BY level_id ASC";
												$query_level = mysqli_query($conn, $sql_level);
												while($row_level = mysqli_fetch_array($query_level)) {
											?>
                                        	<option value="<?php echo $row_level['level_id'];?>" <?php if($rows['level_id'] == $row_level['level_id']) echo 'selected'; ?>>
												<?php echo $row_level['level_name'];?>
											</option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
            </div>
          </div>
          <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
          	<input type="hidden" name="u_idcard" value="<?php echo $rows['u_idcard'];?>">
          	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
          	<a href="list_user.php" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-reply"></i> กลับหน้ารายการ</a>
          </div>
          </form>
        </div>
</div>
    </section>
  </div>

  <?php include('footer.php');?>
  <div class="control-sidebar-bg"></div>
</div>

	<?php include('import_script.php');?>
</body>
</html>
<?php
  mysqli_close($conn);
?>
