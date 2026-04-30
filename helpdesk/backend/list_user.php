<?php session_start();
	include('../config/connect.php');
	include('type_user.php');
	$sql = "SELECT u.u_idcard, u.u_prefix, u.u_fname, u.u_lname, u.u_mobile, u.u_tel, u.u_status,
 l.level_name, dep.dep_name, p.p_position FROM tb_user AS u
	INNER JOIN tb_user_level AS l ON u.level_id = l.level_id
	INNER JOIN tb_department AS dep ON u.dep_id = dep.dep_id
	INNER JOIN tb_position AS p ON u.p_id = p.p_id
	ORDER BY u.u_idcard ASC";
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

  <div class="content-wrapper">
    <?php include('menu_main.php');?>

    <section class="content">
<div class="row">
		<div class="col-md-12">
		<div style="margin-bottom:14px;">
			<a href="add_user.php" class="btn btn-success btn-sm"><i class="fa fa-user-plus"></i> เพิ่มผู้ใช้งาน</a>
		</div>
          <div class="box">
            <div class="box-header text-center bg-blue">
              <h3 class="box-title"><i class="fa fa-users" style="margin-right:7px;"></i>จัดการข้อมูลผู้ใช้งานระบบ</h3>
            </div>
            <div class="box-body">
              					<form method="post">
                                <table id="table1" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-gray">
                                        	<th width="6%" class="text-center">ลำดับ</th>
                                            <th width="14%">ชื่อผู้ใช้งาน</th>
                                            <th width="16%">ตำแหน่ง</th>
                                            <th width="13%">แผนก</th>
                                            <th width="12%">เบอร์มือถือ</th>
                                            <th width="7%">เบอร์ภายใน</th>
                                            <th width="8%">สิทธิ์การใช้งาน</th>
                                            <th width="10%">สถานะ</th>
                                            <th width="3%">แก้ไข</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
										$i = 1;
										while($rows = mysqli_fetch_array($query)) {
									?>	
                                    	<tr>
                                        	<td align="center"><?php echo $i;?></td>
                                            <td><?php echo $rows['u_prefix'];?><?php echo $rows['u_fname'];?> <?php echo $rows['u_lname'];?></td>
                                            <td><?php echo $rows['p_position'];?></td>
                                            <td><?php echo $rows['dep_name'];?></td>
                                            <td><?php echo $rows['u_mobile'];?></td>
                                            <td><?php echo $rows['u_tel'];?></td>
                                            <td><?php echo $rows['level_name'];?></td>
                                            <td>
                                            	<?php if($rows['u_status'] == '0') { ?>
                                                <span class="badge badge bg-red">ปิดการใช้งาน</span>
                                                <?php } else { ?>
                                                <span class="badge badge bg-green">เปิดการใช้งาน</span>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                            <a href="edit_user.php?u_idcard=<?php echo $rows['u_idcard'];?>" class="btn btn-info btn-sm btn-icon" title="แก้ไข"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <?php include('modal/form-delete-modal.php'); ?>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                                </form>
                                <?php include('action/edit_function.php'); ?>
            </div>
          </div>
        </div>
        <?php include('action/edit_function.php'); ?>
        <?php include('modal/form-edit-modal.php'); ?>
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
