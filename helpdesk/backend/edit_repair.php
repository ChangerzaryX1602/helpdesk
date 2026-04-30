<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
	$r_no = $_GET['r_no'];
	$sql = "SELECT * FROM tb_repair AS r
	INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
	INNER JOIN tb_building AS b ON r.build_id = b.build_id
	INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
	INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
	INNER JOIN tb_status AS s ON r.s_id = s.s_id
	WHERE r.r_no = '$r_no'";	
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
          <form name="form_editrepair" method="post" action="action/action_update_repair.php">
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-pencil-square-o" style="margin-right:7px;"></i>แก้ไขข้อมูลการแจ้งซ่อม</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              			<div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>ผู้แจ้งซ่อม</label>
                                        <input type="text" name="u_name" class="form-control" value="<?php echo $rows['u_prefix']?><?php echo $rows['u_fname']?> <?php echo $rows['u_lname']?>" disabled="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>ประเภทอุปกรณ์</label>
                                        <select name="eq_id" class="form-control" required="">
                                        	<?php $eq_id = $rows['eq_id'];?>
                                        	<option value="<?php echo $rows['eq_id'];?>"><?php echo $rows['eq_name'];?></option>
                                        	<?php
                                            	$sql = "SELECT * FROM tb_equipment WHERE eq_id <> '$eq_id' ORDER BY eq_id ASC";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query)) {
											?>
                                        	<option value="<?php echo $row['eq_id'];?>"><?php echo $row['eq_name'];?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>ชื่ออุปกรณ์</label>
                                        <input type="text" name="r_name" class="form-control" value="<?php echo $rows['r_name'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>หมายเลขเครื่อง</label>
                                        <input type="text" name="r_serialnumber" class="form-control" value="<?php echo $rows['r_serialnumber'];?>" required="">
                                      </div>
                                    </div>
                                    
                                  </div>
                                  <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label>อาการ / สาเหตุ</label>
                                        <textarea name="r_detail" class="form-control"><?php echo $rows['r_detail'];?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>อาคาร / ตึก</label>
                                        <?php $build_id = $rows['build_id'];?>
                                        <select name="build_id" class="form-control" required="">
                                        	<option value="<?php echo $rows['build_id'];?>"><?php echo $rows['build_name'];?></option>
                                        	<?php
                                            	$sql = "SELECT * FROM tb_building WHERE build_id <> '$build_id' ORDER BY build_id ASC";
												$query = mysqli_query($conn, $sql);
												while($row = mysqli_fetch_array($query)) {
											?>
                                        	<option value="<?php echo $row['build_id'];?>"><?php echo $row['build_name'];?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label>ชั้น</label>
                                        <input type="text" name="floor" class="form-control"  value="<?php echo $rows['floor'];?>" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label>ห้อง</label>
                                        <input type="text" name="room" class="form-control"  value="<?php echo $rows['room'];?>" required="">
                                      </div>
                                    </div>
                                  </div>
                                  	
            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="background:var(--gray-50);border-top:1px solid var(--gray-200);border-radius:0 0 10px 10px;padding:14px 20px;">
            	<input type="hidden" name="r_no" class="form-control" value="<?php echo $rows['r_no'];?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-default" style="margin-left:8px;"><i class="fa fa-undo"></i> ล้างข้อมูล</button>
                                
            </div>
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