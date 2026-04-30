<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
	$sql = "SELECT r.*, e.*, b.*, u.u_prefix, u.u_fname, u.u_lname, u.u_mobile, u.u_tel, CONCAT(uu.u_prefix, '', uu.u_fname, ' ', uu.u_lname) AS technician_name, d.*, s.* FROM tb_repair AS r
	INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
	INNER JOIN tb_building AS b ON r.build_id = b.build_id
	INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
	INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
	LEFT JOIN tb_status AS s ON r.s_id = s.s_id
	LEFT JOIN tb_user AS uu ON r.technician_id = uu.u_idcard
	 WHERE r.u_idcard = '".$_SESSION['u_idcard']."'";
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

          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-clock-o" style="margin-right:7px;"></i>รายการข้อมูลการแจ้งซ่อม</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              				<table id="table1" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-gray">
                                        	<th width="4%" class="text-center">ลำดับ</th>
                                            <th width="9%">ประเภทอุปกรณ์</th>
                                            <th width="16%">ชื่ออุปกรณ์</th>
                                            <th width="10%">หมายเลขเครื่อง</th>
                                            <th width="12%">ผู้แจ้งซ่อม</th>
                                            <th width="12%">แผนก</th>
                                            <th width="11%">วันที่แจ้งซ่อม</th>
                                            <th width="11%">สถานะ</th>
                                            <th width="15%">ช่างผู้ดำเนินการซ่อม</th>
 
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
										$i = 1;
										while($rows = mysqli_fetch_array($query)) {
									?>	
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td><?php echo $rows['eq_name'];?></td>
                                            <td><?php echo $rows['r_name'];?><br>อาการ : <?php echo $rows['r_detail'];?>
											</td>
                                            <td><?php echo $rows['r_serialnumber'];?></td>
                                            <td><?php echo $rows['u_prefix'];?><?php echo $rows['u_fname'];?> <?php echo $rows['u_lname'];?></td>
                                            <td><?php echo $rows['dep_name'];?></td>
                                            <td><?php echo date_format(date_create($rows['r_save']),"d/m/Y H:i:s");?></td>
                                             <td><?php echo $rows['s_status'];?></td>
                                            <td><?php echo $rows['technician_name'];?></td>
											
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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