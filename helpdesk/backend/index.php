<?php
session_start();
include('../config/connect.php');
include('type_user.php');

function fetchCount($conn, $sql, $alias = 'total')
{
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return isset($row[$alias]) ? (int) $row[$alias] : 0;
}

function fetchGroupedRows($conn, $sql, $labelKey, $valueKey)
{
    $rows = array();
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return $rows;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = array(
            'label' => $row[$labelKey],
            'value' => (int) $row[$valueKey],
        );
    }

    return $rows;
}

function buildChartData($labelHeader, $valueHeader, $rows)
{
    $data = array(array($labelHeader, $valueHeader));

    foreach ($rows as $row) {
        $data[] = array($row['label'], (int) $row['value']);
    }

    return $data;
}

$totalRepairs = fetchCount($conn, "SELECT COUNT(*) AS total FROM tb_repair");
$totalUsers = fetchCount($conn, "SELECT COUNT(*) AS total FROM tb_user");
$totalEquipment = fetchCount($conn, "SELECT COUNT(*) AS total FROM tb_equipment");
$totalDepartments = fetchCount($conn, "SELECT COUNT(*) AS total FROM tb_department");

$equipmentRows = fetchGroupedRows(
    $conn,
    "SELECT e.eq_name, COUNT(r.r_no) AS total
     FROM tb_repair AS r
     INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
     GROUP BY e.eq_id, e.eq_name
     ORDER BY total DESC, e.eq_name ASC",
    'eq_name',
    'total'
);

$statusRows = fetchGroupedRows(
    $conn,
    "SELECT s.s_status, COUNT(r.r_no) AS total
     FROM tb_repair AS r
     INNER JOIN tb_status AS s ON r.s_id = s.s_id
     GROUP BY s.s_id, s.s_status
     ORDER BY total DESC, s.s_status ASC",
    's_status',
    'total'
);

$departmentRows = fetchGroupedRows(
    $conn,
    "SELECT d.dep_name, COUNT(r.r_no) AS total
     FROM tb_repair AS r
     INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
     INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
     GROUP BY d.dep_id, d.dep_name
     ORDER BY total DESC, d.dep_name ASC",
    'dep_name',
    'total'
);

$equipmentChartJson = json_encode(buildChartData('อุปกรณ์', 'จำนวน', $equipmentRows), JSON_UNESCAPED_UNICODE);
$statusChartJson = json_encode(buildChartData('สถานะ', 'จำนวน', $statusRows), JSON_UNESCAPED_UNICODE);
$departmentChartJson = json_encode(buildChartData('แผนก', 'จำนวน', $departmentRows), JSON_UNESCAPED_UNICODE);
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

    <section class="content dashboard-page">
      <div class="dashboard-hero">
        <div class="dashboard-hero-copy">
          <span class="dashboard-kicker">Dashboard Overview</span>
          <h1>ภาพรวมงานแจ้งซ่อมของระบบ</h1>
          <p>ติดตามข้อมูลสำคัญของ HelpDesk ได้จากหน้าเดียว ทั้งจำนวนรายการซ่อม ผู้ใช้งานในระบบ สัดส่วนตามอุปกรณ์ สถานะงาน และแผนกที่แจ้งงานมากที่สุด</p>
        </div>
        <div class="dashboard-hero-side">
          <div class="dashboard-hero-meta">
            <span>อัปเดตล่าสุด</span>
            <strong><?php echo date('d/m/Y H:i'); ?></strong>
            <small>แสดงข้อมูลจากฐานข้อมูลปัจจุบัน</small>
          </div>
          <a href="list_repair.php" class="btn btn-primary">
            <i class="fa fa-list-alt"></i> ดูรายการแจ้งซ่อม
          </a>
        </div>
      </div>

      <div class="dashboard-stats-grid">
        <div class="dashboard-stat-card accent-blue">
          <div class="dashboard-stat-icon">
            <i class="fa fa-wrench"></i>
          </div>
          <div class="dashboard-stat-content">
            <span>รายการแจ้งซ่อมทั้งหมด</span>
            <strong><?php echo number_format($totalRepairs); ?></strong>
            <small>จำนวนคำขอซ่อมที่บันทึกในระบบ</small>
          </div>
        </div>

        <div class="dashboard-stat-card accent-cyan">
          <div class="dashboard-stat-icon">
            <i class="fa fa-users"></i>
          </div>
          <div class="dashboard-stat-content">
            <span>ผู้ใช้งานทั้งหมด</span>
            <strong><?php echo number_format($totalUsers); ?></strong>
            <small>รวมบัญชีผู้ใช้งานทุกระดับสิทธิ์</small>
          </div>
        </div>

        <div class="dashboard-stat-card accent-green">
          <div class="dashboard-stat-icon">
            <i class="fa fa-desktop"></i>
          </div>
          <div class="dashboard-stat-content">
            <span>หมวดอุปกรณ์</span>
            <strong><?php echo number_format($totalEquipment); ?></strong>
            <small>ประเภทอุปกรณ์ที่ใช้ในระบบ</small>
          </div>
        </div>

        <div class="dashboard-stat-card accent-indigo">
          <div class="dashboard-stat-icon">
            <i class="fa fa-sitemap"></i>
          </div>
          <div class="dashboard-stat-content">
            <span>แผนกทั้งหมด</span>
            <strong><?php echo number_format($totalDepartments); ?></strong>
            <small>แผนกที่สามารถแจ้งซ่อมได้</small>
          </div>
        </div>
      </div>

      <div class="dashboard-panels-grid">
        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>สัดส่วนตามอุปกรณ์</h3>
              <p>ดูว่าอุปกรณ์ประเภทใดถูกแจ้งซ่อมบ่อยที่สุด</p>
            </div>
          </div>
          <div id="chart-equipment" class="dashboard-chart"></div>
        </div>

        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>สัดส่วนตามสถานะงาน</h3>
              <p>มองภาพรวมสถานะของงานซ่อมทั้งหมดในระบบ</p>
            </div>
          </div>
          <div id="chart-status" class="dashboard-chart"></div>
        </div>

        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>เปรียบเทียบตามแผนก</h3>
              <p>แสดงจำนวนการแจ้งซ่อมแยกตามหน่วยงานที่ใช้งาน</p>
            </div>
          </div>
          <div id="chart-department" class="dashboard-chart"></div>
        </div>
      </div>

      <div class="dashboard-panels-grid">
        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>อันดับอุปกรณ์ที่ถูกแจ้งซ่อม</h3>
              <p>สรุปจำนวนแบบเรียงจากมากไปน้อย</p>
            </div>
          </div>
          <div class="dashboard-table-wrap">
            <table class="table table-hover dashboard-summary-table">
              <thead>
                <tr class="bg-gray">
                  <th class="text-center">ลำดับ</th>
                  <th>อุปกรณ์</th>
                  <th class="text-center">จำนวน</th>
                </tr>
              </thead>
              <tbody>
              <?php if (empty($equipmentRows)) { ?>
                <tr>
                  <td colspan="3" class="text-center">ยังไม่มีข้อมูล</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($equipmentRows as $index => $row) { ?>
                <tr>
                  <td class="text-center"><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($row['label']); ?></td>
                  <td class="text-center"><span class="badge badge bg-blue"><?php echo number_format($row['value']); ?></span></td>
                </tr>
                <?php } ?>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>อันดับสถานะงาน</h3>
              <p>ตรวจสอบว่าสถานะใดเกิดขึ้นมากที่สุด</p>
            </div>
          </div>
          <div class="dashboard-table-wrap">
            <table class="table table-hover dashboard-summary-table">
              <thead>
                <tr class="bg-gray">
                  <th class="text-center">ลำดับ</th>
                  <th>สถานะ</th>
                  <th class="text-center">จำนวน</th>
                </tr>
              </thead>
              <tbody>
              <?php if (empty($statusRows)) { ?>
                <tr>
                  <td colspan="3" class="text-center">ยังไม่มีข้อมูล</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($statusRows as $index => $row) { ?>
                <tr>
                  <td class="text-center"><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($row['label']); ?></td>
                  <td class="text-center"><span class="badge badge bg-green"><?php echo number_format($row['value']); ?></span></td>
                </tr>
                <?php } ?>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="dashboard-panel">
          <div class="dashboard-panel-head">
            <div>
              <h3>อันดับแผนกที่แจ้งซ่อม</h3>
              <p>ช่วยเห็นหน่วยงานที่มีภาระงานซ่อมสูง</p>
            </div>
          </div>
          <div class="dashboard-table-wrap">
            <table class="table table-hover dashboard-summary-table">
              <thead>
                <tr class="bg-gray">
                  <th class="text-center">ลำดับ</th>
                  <th>แผนก</th>
                  <th class="text-center">จำนวน</th>
                </tr>
              </thead>
              <tbody>
              <?php if (empty($departmentRows)) { ?>
                <tr>
                  <td colspan="3" class="text-center">ยังไม่มีข้อมูล</td>
                </tr>
              <?php } else { ?>
                <?php foreach ($departmentRows as $index => $row) { ?>
                <tr>
                  <td class="text-center"><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($row['label']); ?></td>
                  <td class="text-center"><span class="badge badge bg-purple"><?php echo number_format($row['value']); ?></span></td>
                </tr>
                <?php } ?>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>

<?php include('import_script.php'); ?>
<script type="text/javascript" src="assets/chart-pie/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages': ['corechart']});
  google.charts.setOnLoadCallback(drawDashboardCharts);

  function renderNoData(containerId) {
    var container = document.getElementById(containerId);
    if (!container) {
      return;
    }

    container.innerHTML = '<div class="dashboard-empty-chart">ยังไม่มีข้อมูลสำหรับแสดงกราฟ</div>';
  }

  function drawDonutChart(containerId, rows, colors) {
    if (!rows || rows.length <= 1) {
      renderNoData(containerId);
      return;
    }

    var data = google.visualization.arrayToDataTable(rows);
    var chart = new google.visualization.PieChart(document.getElementById(containerId));
    chart.draw(data, {
      pieHole: 0.55,
      chartArea: {left: 20, top: 20, width: '90%', height: '78%'},
      legend: {position: 'bottom', textStyle: {fontSize: 12, color: '#475569'}},
      colors: colors,
      pieSliceTextStyle: {color: '#0f172a', fontSize: 12},
      backgroundColor: 'transparent',
      fontName: 'Sarabun'
    });
  }

  function drawBarChart(containerId, rows, colors) {
    if (!rows || rows.length <= 1) {
      renderNoData(containerId);
      return;
    }

    var data = google.visualization.arrayToDataTable(rows);
    var chart = new google.visualization.BarChart(document.getElementById(containerId));
    chart.draw(data, {
      chartArea: {left: 90, top: 16, width: '78%', height: '74%'},
      legend: {position: 'none'},
      colors: colors,
      backgroundColor: 'transparent',
      hAxis: {
        minValue: 0,
        textStyle: {fontSize: 11, color: '#64748b'},
        gridlines: {color: '#e2e8f0'}
      },
      vAxis: {
        textStyle: {fontSize: 12, color: '#334155'}
      },
      fontName: 'Sarabun'
    });
  }

  function drawDashboardCharts() {
    drawDonutChart('chart-equipment', <?php echo $equipmentChartJson; ?>, ['#2563eb', '#38bdf8', '#22c55e', '#f59e0b', '#8b5cf6', '#ef4444']);
    drawDonutChart('chart-status', <?php echo $statusChartJson; ?>, ['#0ea5e9', '#22c55e', '#f97316', '#ef4444', '#8b5cf6', '#14b8a6']);
    drawBarChart('chart-department', <?php echo $departmentChartJson; ?>, ['#2563eb']);
  }

  window.addEventListener('resize', function () {
    if (window.google && google.visualization) {
      drawDashboardCharts();
    }
  });
</script>
</body>
</html>
<?php
mysqli_close($conn);
?>
