<?php session_start();
	include('../config/connect.php');
	include('type_user.php');

	if(!in_array($_SESSION['level_id'], array('01','02','04'))) {
		echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location='dashboard.php';</script>";
		exit();
	}

	$sql = "SELECT r.*, d.dep_name, e.eq_name FROM tb_equipment_registry AS r
			LEFT JOIN tb_department AS d ON r.dep_id = d.dep_id
			LEFT JOIN tb_equipment AS e ON r.eq_id = e.eq_id
			ORDER BY r.reg_id DESC";
	$query = mysqli_query($conn, $sql);
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
			<div style="margin-bottom:14px;">
				<a href="add_equipment_registry.php" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> เพิ่มทะเบียนอุปกรณ์</a>
			</div>
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-database" style="margin-right:7px;"></i>ระบบทะเบียนอุปกรณ์</h3>
            </div>
            <div class="box-body">
                                <table id="example" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-gray">
                                        	<th width="5%" class="text-center">ลำดับ</th>
                                            <th width="12%">เลขครุภัณฑ์</th>
                                            <th width="9%">ประเภท</th>
                                            <th width="14%">ยี่ห้อ/รุ่น</th>
                                            <th width="12%">Computer Name</th>
                                            <th width="14%">ผู้ใช้งาน</th>
                                            <th width="12%">หน่วยงาน</th>
                                            <th width="10%">IP Address</th>
                                            <th width="6%" class="text-center">แก้ไข</th>
                                            <th width="6%" class="text-center">ลบ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
										$i = 1;
										while($rows = mysqli_fetch_array($query)) {
									?>
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td><?php echo htmlspecialchars($rows['reg_asset_no']);?></td>
                                            <td><?php echo htmlspecialchars($rows['eq_name']);?></td>
                                            <td><?php echo htmlspecialchars($rows['reg_brand_model']);?></td>
                                            <td><?php echo htmlspecialchars($rows['reg_computer_name']);?></td>
                                            <td><?php echo htmlspecialchars($rows['reg_user_name']);?></td>
                                            <td><?php echo htmlspecialchars($rows['dep_name']);?></td>
                                            <td><?php echo htmlspecialchars($rows['reg_ip']);?></td>
                                            <td align="center">
                                            	<a href="edit_equipment_registry.php?id=<?php echo $rows['reg_id'];?>" class="btn btn-success btn-sm btn-icon" title="แก้ไข"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td align="center">
                                            	<button type="button" class="btn btn-warning btn-sm btn-icon" data-toggle="modal" data-target="#deleteRegModal<?php echo $rows['reg_id'];?>" title="ลบ"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Delete confirm modal -->
                                        <div class="modal fade" id="deleteRegModal<?php echo $rows['reg_id'];?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-red">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"><i class="fa fa-trash"></i> ยืนยันการลบ</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>ต้องการลบทะเบียนอุปกรณ์ <strong><?php echo htmlspecialchars($rows['reg_asset_no']);?></strong> (<?php echo htmlspecialchars($rows['reg_brand_model']);?>) ใช่หรือไม่?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                        <a href="action/action_delete_equipment_registry.php?id=<?php echo $rows['reg_id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
            </div>
          </div>
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
