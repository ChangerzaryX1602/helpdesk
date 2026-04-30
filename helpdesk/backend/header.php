<?php
$notificationCount = 0;
if (isset($conn, $record['u_idcard'])) {
  $notificationUserId = mysqli_real_escape_string($conn, $record['u_idcard']);
  $notificationResult = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM tb_notification
     WHERE user_id = '$notificationUserId' AND is_read = '0'"
  );

  if ($notificationResult && mysqli_num_rows($notificationResult) > 0) {
    $notificationRow = mysqli_fetch_assoc($notificationResult);
    $notificationCount = (int) $notificationRow['total'];
  }
}
?>
<header class="main-header">
    <a href="dashboard.php" class="logo">
      <span class="logo-mini"><b><i class="fa fa-wrench"></i></b></span>
      <span class="logo-lg"><i class="fa fa-wrench" style="margin-right:8px;color:#60a5fa;"></i><b>HelpDesk</b></span>
    </a>

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="notification.php" title="แจ้งเตือน">
              <i class="fa fa-bell-o"></i>
              <span class="hidden-xs">แจ้งเตือน</span>
              <?php if ($notificationCount > 0) { ?>
                <span class="navbar-notify-badge"><?php echo $notificationCount; ?></span>
              <?php } ?>
            </a>
          </li>

          <li>
            <a href="#" style="pointer-events:none; cursor:default;">
              <i class="fa fa-user-circle-o"></i>
              <span class="hidden-xs">ยินดีต้อนรับ : <?php echo $record['u_fname']; ?> <?php echo $record['u_lname']; ?></span>
            </a>
          </li>

          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out"></i>
              <span class="hidden-xs">ออกจากระบบ</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
</header>
