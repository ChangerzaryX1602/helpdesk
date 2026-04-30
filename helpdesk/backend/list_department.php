<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
	$sql = "SELECT * FROM tb_department ORDER BY dep_id ASC";
	$query = mysqli_query($conn, $sql);
    $rowModals = '';
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
<?php include('modal/form-add-modal.php');?>
		<div style="margin-bottom:14px;">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_department">
				<i class="fa fa-plus-circle"></i> เพิ่มแผนก
			</button>
		</div>
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-sitemap" style="margin-right:7px;"></i>จัดการข้อมูลแผนก</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                                <table id="example" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-gray">
                                        	<th width="6%" class="text-center">ลำดับ</th>
                                            <th width="88%">ชื่อแผนก</th>
                                            <th width="3%">แก้ไข</th>
                                            <th width="3%">ลบ</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
										$i = 1;
										while($rows = mysqli_fetch_array($query)) {
                                            ob_start();
                                            include('modal/form-edit-modal.php');
                                            include('modal/form-delete-modal.php');
                                            $rowModals .= ob_get_clean();
									?>	
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td><?php echo $rows['dep_name'];?></td>
											<td>
                                            	<button type="button" class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#editDepartmentModal<?php echo $rows['dep_id'];?>"><span class="fa fa-edit"></span></button>
                                            </td>
                                            <td>
                                            	<button type="button" class="btn btn-warning btn-sm btn-icon" data-toggle="modal" data-target="#deleteDepartmentModal<?php echo $rows['dep_id'];?>"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                                <?php echo $rowModals; ?>
                                <?php include('action/add_function.php'); ?>
                                <?php include('action/edit_function.php'); ?>
                                <?php include('action/delete_function.php'); ?>
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
