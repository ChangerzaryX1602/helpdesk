<?php
session_start();
include('../config/connect.php');
include('type_user.php');

$currentUserId = mysqli_real_escape_string($conn, $record['u_idcard']);

mysqli_query(
	$conn,
	"UPDATE tb_notification
	 SET is_read = '1'
	 WHERE user_id = '$currentUserId' AND is_read = '0'"
);

$notificationQuery = mysqli_query(
	$conn,
	"SELECT *
	 FROM tb_notification
	 WHERE user_id = '$currentUserId'
	 ORDER BY created_at DESC, notify_id DESC"
);
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
      <div class="box">
        <div class="box-body">
          <div class="notification-page-head">
            <div>
              <h2>แจ้งเตือนของฉัน</h2>
              <p>รายการอัปเดตล่าสุดของงานซ่อมที่เกี่ยวข้องกับคุณ</p>
            </div>
          </div>

          <div class="notification-list">
            <?php if ($notificationQuery && mysqli_num_rows($notificationQuery) > 0) { ?>
              <?php while ($notification = mysqli_fetch_array($notificationQuery)) { ?>
                <div class="notification-item-card">
                  <div class="notification-item-main">
                    <div class="notification-item-title-row">
                      <strong><?php echo htmlspecialchars($notification['title']); ?></strong>
                      <span><?php echo date_format(date_create($notification['created_at']), "d/m/Y H:i"); ?></span>
                    </div>
                    <p><?php echo nl2br(htmlspecialchars($notification['message'])); ?></p>
                  </div>
                  <?php if (!empty($notification['r_no'])) { ?>
                    <a href="view_repair.php?r_no=<?php echo urlencode($notification['r_no']); ?>" class="btn btn-primary btn-sm">
                      <i class="fa fa-file-text-o"></i> เปิดงาน
                    </a>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } else { ?>
              <div class="repair-empty-state">ยังไม่มีรายการแจ้งเตือน</div>
            <?php } ?>
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
<?php mysqli_close($conn); ?>
