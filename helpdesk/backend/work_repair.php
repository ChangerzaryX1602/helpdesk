<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
	$sql = "SELECT r.*, e.eq_name, b.build_name, d.dep_name, p.p_position, s.s_status, u.u_prefix, u.u_fname, u.u_lname, u.u_mobile, u.u_tel, CONCAT(uu.u_prefix, '', uu.u_fname, ' ', uu.u_lname) AS technician_name, CONCAT(uuu.u_prefix, '', uuu.u_fname, ' ', uuu.u_lname) AS head_name FROM tb_repair AS r
	INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
	INNER JOIN tb_building AS b ON r.build_id = b.build_id
	INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
	INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
	INNER JOIN tb_position AS p ON u.p_id = p.p_id
	INNER JOIN tb_status AS s ON r.s_id = s.s_id
	LEFT JOIN tb_user AS uu ON r.technician_id = uu.u_idcard
	LEFT JOIN tb_user AS uuu ON r.head_id = uuu.u_idcard
	 WHERE r.technician_id = '".$_SESSION['u_idcard']."'
	 GROUP BY r.no
	 ORDER BY r.r_no ASC";
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
        <!-- Button trigger modal -->
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-wrench" style="margin-right:7px;"></i>งานซ่อมที่ได้รับมอบหมาย</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                                <p style="font-size:10px; color:#F00;">*** หมายเหตุ หากสถานะดำเนินการสำเร็จ ไม่สามารถทำรายการได้อีก</p>
                                <table id="table1" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-green">
                                        	<th width="3%" class="text-center">ลำดับ</th>   
                                            <th width="7%">ประเภทอุปกรณ์</th>
                                            <th width="11%">ชื่ออุปกรณ์</th>
                                            <th width="8%">หมายเลขเครื่อง</th>
                                            <th width="12%">ผู้แจ้งซ่อม</th>
                                            <th width="9%">แผนก</th>
                                            <th width="10%">วันที่แจ้งซ่อม</th>
                                            <th width="11%">ช่างผู้รับผิดชอบ</th>
                                            <th width="15%">สถานะ</th>
                                            <th width="6%" class="text-center">รายละเอียด</th>
                                            <th width="8%" class="text-center">อัปเดตสถานะ</th>
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
                                            <td><?php echo $rows['r_name'];?></td>
                                            <td><?php echo $rows['r_serialnumber'];?></td>
                                            <td><?php echo $rows['u_prefix'];?><?php echo $rows['u_fname'];?> <?php echo $rows['u_lname'];?>	
                                            </td>
                                            <td><?php echo $rows['dep_name'];?></td>
                                            <td><?php echo date_format(date_create($rows['r_save']),"d/m/Y H:i:s");?></td>
                                            <td><?php echo $rows['technician_name'];?>
                                            	<br>มอบหมายโดย : <?php echo $rows['head_name'];?>
                                            </td>
                                            <td>
                                            	<?php
                                                	if($rows['s_id'] == '1') {
												?>
                                                <span class="badge badge bg-gray"><?php echo $rows['s_status'];?></span>
                                                <?php } else if($rows['s_id'] == '2') { ?>
                                                <span class="badge badg bg-purple"><?php echo $rows['s_status'];?></span>
                                                <?php }else if($rows['s_id'] == '3') { ?>
                                                <span class="badge badge bg-blue"><?php echo $rows['s_status'];?></span>
                                                <?php } else if($rows['s_id'] == '4') { ?>
                                                <span class="badge badge bg-green"><?php echo $rows['s_status'];?></span>
                                                <?php } else { ?>
                                                <span class="badge badge bg-red"><?php echo $rows['s_status'];?></span>
                                                <?php } ?>
                                                
                                            </td>
                                            <td align="center">
                                            	<a href="view_repair.php?r_no=<?php echo $rows['r_no'];?>"><button type="button" class="btn btn-default btn-sm btn-round btn-icon"><span class="fa fa-file-text"></span></button></a>
                                            </td>
											<td align="center">
                                            	<?php $s_id = $rows['s_id'];?>
                                                <?php if($rows['s_id'] == '4') { ?> 
                                                 <button type="button" disabled="disabled" class="btn btn-success btn-sm"><span class="fa fa-random"></span></button>
                                                <?php } else { ?>
                                                 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#sentRepairModal<?php echo $rows['r_no'];?>"><span class="fa fa-random (alias)"></span></button>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>

                                <?php
                                    mysqli_data_seek($query, 0);
                                    while ($rows = mysqli_fetch_array($query)) {
                                        include('modal/form-edit-modal.php');
                                    }
                                ?>

                                <?php include('action/edit_function.php'); ?>
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