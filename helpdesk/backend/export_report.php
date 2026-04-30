<?php
session_start();
include('../config/connect.php');
include('type_user.php');

$dateStart = isset($_POST['dateStart']) ? $_POST['dateStart'] : '';
$dateEnd = isset($_POST['dateEnd']) ? $_POST['dateEnd'] : '';
$technician = isset($_POST['technician']) ? $_POST['technician'] : '';

$sql = "SELECT r.*, e.*, b.*, u.u_prefix, u.u_fname, u.u_lname, u.u_mobile, u.u_tel,
        CONCAT(uu.u_prefix, '', uu.u_fname, ' ', uu.u_lname) AS technician_name, d.*, s.*
        FROM tb_repair AS r
        INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
        INNER JOIN tb_building AS b ON r.build_id = b.build_id
        INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
        INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
        LEFT JOIN tb_status AS s ON r.s_id = s.s_id
        LEFT JOIN tb_user AS uu ON r.technician_id = uu.u_idcard
        WHERE DATE_FORMAT(r.r_save, '%Y-%m-%d') BETWEEN '$dateStart' AND '$dateEnd'";

if ($technician == "") {
	$sql .= " ORDER BY r.r_save ASC";
} else {
	$sql .= " AND r.technician_id = '$technician' ORDER BY r.r_save ASC";
}

$query = mysqli_query($conn, $sql);
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
          <form method="post" name="frm_search" action="">
            <div class="form-row">
              <div class="col-md-2">
                <label>ตั้งแต่วันที่</label>
                <input type="date" name="dateStart" class="form-control" value="<?php echo $dateStart; ?>" required>
              </div>
              <div class="col-md-2">
                <label>ถึงวันที่</label>
                <input type="date" name="dateEnd" class="form-control" value="<?php echo $dateEnd; ?>" required>
              </div>
              <div class="col-md-3">
                <label>นายช่างผู้ดำเนินการซ่อม</label>
                <select name="technician" class="form-control">
                  <option value="">แสดงทั้งหมด</option>
                  <?php
                  $sql3 = "SELECT u_prefix, u_fname, u_lname, u_idcard FROM tb_user WHERE level_id = '01' ORDER BY u_idcard ASC";
                  $query3 = mysqli_query($conn, $sql3);
                  while ($row3 = mysqli_fetch_array($query3)) {
                    $selected = ($technician == $row3['u_idcard']) ? 'selected' : '';
                  ?>
                    <option value="<?php echo $row3['u_idcard']; ?>" <?php echo $selected; ?>>
                      <?php echo $row3['u_prefix'] . $row3['u_fname'] . ' ' . $row3['u_lname']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-5 report-filter-actions">
                <button type="submit" name="btn_search" class="btn btn-success report-search-btn">
                  <i class="fa fa-search"></i> ค้นหา
                </button>
                <a href="#" id="download_link" class="report-export-link report-export-inline" onclick="ExcelReport(); return false;">
                  <span id="btn-excel"><img src="../icon/excel.png" alt="Excel"> Export Excel</span>
                </a>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-12">
          <p></p>
          <div class="box">
            <div class="box-body">
              <table id="table1" width="100%" class="table table-hover">
                <thead>
                  <tr class="bg-gray">
                    <th width="3%" class="text-center">ลำดับ</th>
                    <th width="10%">ประเภทอุปกรณ์</th>
                    <th width="15%">ชื่ออุปกรณ์</th>
                    <th width="9%">หมายเลขเครื่อง</th>
                    <th width="14%">ผู้แจ้งซ่อม</th>
                    <th width="12%">แผนก</th>
                    <th width="13%">วันที่แจ้งซ่อม</th>
                    <th width="14%">นายช่างผู้ดำเนินการซ่อม</th>
                    <th width="10%">สถานะ</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while ($rows = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td><?php echo $rows['eq_name']; ?></td>
                    <td><?php echo $rows['r_name']; ?></td>
                    <td><?php echo $rows['r_serialnumber']; ?></td>
                    <td><?php echo $rows['u_prefix'] . $rows['u_fname'] . ' ' . $rows['u_lname']; ?></td>
                    <td><?php echo $rows['dep_name']; ?></td>
                    <td align="center"><?php echo date_format(date_create($rows['r_save']), "d/m/Y H:i:s"); ?></td>
                    <td><?php echo $rows['technician_name']; ?></td>
                    <td><?php echo $rows['s_status']; ?></td>
                  </tr>
                <?php
                  $i++;
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
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
<?php
mysqli_close($conn);
?>
