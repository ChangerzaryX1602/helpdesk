<?php
session_start();
include('../config/connect.php');
include('type_user.php');
include('action/repair_tracking_helper.php');

$r_no = isset($_GET['r_no']) ? $_GET['r_no'] : '';
$currentUserId = isset($_SESSION['u_idcard']) ? $_SESSION['u_idcard'] : '';
$currentLevelId = isset($record['level_id']) ? $record['level_id'] : '';
$hasFullRepairAccess = in_array($currentLevelId, ['01', '02', '04'], true);

if (isset($_POST['btnAddRepairNote'])) {
	$commentText = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : '';
	$hasUpload = isset($_FILES['attachment']) && is_array($_FILES['attachment']) && (int) $_FILES['attachment']['error'] === UPLOAD_ERR_OK && (int) $_FILES['attachment']['size'] > 0;

	if ($commentText === '' && !$hasUpload) {
		$_SESSION['repair_flash'] = ['type' => 'error', 'message' => 'กรุณากรอกหมายเหตุหรือแนบไฟล์อย่างน้อย 1 รายการ'];
		header('Location: view_repair.php?r_no=' . urlencode($r_no));
		exit();
	}

	$didSave = false;
	if ($commentText !== '') {
		$didSave = repairInsertComment($conn, $r_no, $currentUserId, $commentText, 'comment') || $didSave;
	}

	$uploadResult = repairHandleAttachmentUpload($conn, 'attachment', $r_no, $currentUserId);
	if ($uploadResult !== null && $uploadResult !== false) {
		$didSave = true;
	}

	if ($didSave) {
		$currentRepairForLog = repairGetCurrentRepairRow($conn, $r_no);
		if ($currentRepairForLog) {
			repairInsertLog(
				$conn,
				$r_no,
				$currentRepairForLog['s_id'],
				$currentRepairForLog['technician_id'],
				$currentUserId,
				gethostbyaddr($_SERVER['REMOTE_ADDR']),
				$_SERVER['REMOTE_ADDR'],
				isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown',
				date('Y-m-d H:i:s'),
				'comment',
				$currentRepairForLog['s_id'],
				$commentText !== '' ? 'เพิ่มหมายเหตุในงานซ่อม' : 'แนบไฟล์ในงานซ่อม'
			);
		}

		$_SESSION['repair_flash'] = ['type' => 'success', 'message' => 'บันทึกหมายเหตุเรียบร้อยแล้ว'];
	} else {
		$_SESSION['repair_flash'] = ['type' => 'error', 'message' => 'ไม่สามารถบันทึกข้อมูลได้'];
	}

	header('Location: view_repair.php?r_no=' . urlencode($r_no));
	exit();
}

$permissionWhere = $hasFullRepairAccess
	? "r.r_no = '" . repairEscape($conn, $r_no) . "'"
	: "r.r_no = '" . repairEscape($conn, $r_no) . "' AND (
		r.technician_id = '" . repairEscape($conn, $currentUserId) . "'
		OR r.u_idcard = '" . repairEscape($conn, $currentUserId) . "'
		OR r.head_id = '" . repairEscape($conn, $currentUserId) . "'
	)";

$sql = "SELECT r.*, e.eq_name, b.build_name, d.dep_name, p.p_position, s.s_status, wl.wl_name,
		CONCAT(u.u_prefix, u.u_fname, ' ', u.u_lname) AS requester_name,
		CONCAT(uu.u_prefix, uu.u_fname, ' ', uu.u_lname) AS technician_name,
		CONCAT(uuu.u_prefix, uuu.u_fname, ' ', uuu.u_lname) AS head_name
		FROM tb_repair AS r
		INNER JOIN tb_equipment AS e ON r.eq_id = e.eq_id
		INNER JOIN tb_building AS b ON r.build_id = b.build_id
		INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
		INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
		INNER JOIN tb_position AS p ON u.p_id = p.p_id
		LEFT JOIN tb_status AS s ON r.s_id = s.s_id
		LEFT JOIN tb_work_level AS wl ON r.wl_id = wl.wl_id
		LEFT JOIN tb_user AS uu ON r.technician_id = uu.u_idcard
		LEFT JOIN tb_user AS uuu ON r.head_id = uuu.u_idcard
		WHERE $permissionWhere
		LIMIT 1";
$query = mysqli_query($conn, $sql);
$rows = $query ? mysqli_fetch_array($query) : null;

if (!$rows) {
	echo 'ไม่พบข้อมูล';
	exit();
}

$comments = mysqli_query(
	$conn,
	"SELECT c.*, CONCAT(u.u_prefix, u.u_fname, ' ', u.u_lname) AS commenter_name
	 FROM tb_repair_comment AS c
	 LEFT JOIN tb_user AS u ON c.user_id = u.u_idcard
	 WHERE c.r_no = '" . repairEscape($conn, $r_no) . "'
	 ORDER BY c.created_at DESC, c.comment_id DESC"
);

$attachments = mysqli_query(
	$conn,
	"SELECT a.*, CONCAT(u.u_prefix, u.u_fname, ' ', u.u_lname) AS uploader_name
	 FROM tb_repair_attachment AS a
	 LEFT JOIN tb_user AS u ON a.uploaded_by = u.u_idcard
	 WHERE a.r_no = '" . repairEscape($conn, $r_no) . "'
	 ORDER BY a.uploaded_at DESC, a.attachment_id DESC"
);

$logs = mysqli_query(
	$conn,
	"SELECT l.*, snew.s_status AS new_status_name, sold.s_status AS old_status_name,
	        CONCAT(u.u_prefix, u.u_fname, ' ', u.u_lname) AS actor_name,
	        CONCAT(t.u_prefix, t.u_fname, ' ', t.u_lname) AS log_technician_name
	 FROM tb_repair_log AS l
	 LEFT JOIN tb_status AS snew ON l.s_id = snew.s_id
	 LEFT JOIN tb_status AS sold ON l.old_s_id = sold.s_id
	 LEFT JOIN tb_user AS u ON l.user_id = u.u_idcard
	 LEFT JOIN tb_user AS t ON l.technician_id = t.u_idcard
	 WHERE l.r_no = '" . repairEscape($conn, $r_no) . "'
	 ORDER BY l.rlog_save DESC, l.rlog_id DESC"
);

$flash = isset($_SESSION['repair_flash']) ? $_SESSION['repair_flash'] : null;
unset($_SESSION['repair_flash']);
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
      <?php if ($flash) { ?>
        <div class="alert <?php echo $flash['type'] === 'success' ? 'alert-success' : 'alert-danger'; ?>">
          <?php echo $flash['message']; ?>
        </div>
      <?php } ?>

      <div class="repair-detail-page">
        <div class="box">
          <div class="box-body">
            <div class="repair-detail-header">
              <div>
                <div class="repair-ticket-label">เลขที่แจ้งซ่อม</div>
                <h2 class="repair-ticket-no"><?php echo $rows['r_no']; ?></h2>
                <p class="repair-ticket-subtitle"><?php echo $rows['eq_name']; ?> / <?php echo $rows['r_name']; ?></p>
              </div>
              <div class="repair-ticket-status-group">
                <span class="repair-detail-badge badge badge bg-blue"><?php echo $rows['s_status']; ?></span>
                <span class="repair-detail-badge badge badge bg-green"><?php echo $rows['wl_name'] ? $rows['wl_name'] : 'ปกติ'; ?></span>
              </div>
            </div>

            <div class="repair-detail-grid">
              <div class="repair-detail-item"><span>ผู้แจ้งซ่อม</span><strong><?php echo $rows['requester_name']; ?></strong></div>
              <div class="repair-detail-item"><span>ตำแหน่ง / แผนก</span><strong><?php echo $rows['p_position']; ?> / <?php echo $rows['dep_name']; ?></strong></div>
              <div class="repair-detail-item"><span>อาคาร / ห้อง</span><strong><?php echo $rows['build_name']; ?> ชั้น <?php echo $rows['floor']; ?> ห้อง <?php echo $rows['room']; ?></strong></div>
              <div class="repair-detail-item"><span>Serial Number</span><strong><?php echo $rows['r_serialnumber']; ?></strong></div>
              <div class="repair-detail-item"><span>ผู้รับผิดชอบ</span><strong><?php echo $rows['technician_name'] ? $rows['technician_name'] : '-'; ?></strong></div>
              <div class="repair-detail-item"><span>ผู้มอบหมาย</span><strong><?php echo $rows['head_name'] ? $rows['head_name'] : '-'; ?></strong></div>
              <div class="repair-detail-item"><span>วันที่แจ้งซ่อม</span><strong><?php echo date_format(date_create($rows['r_save']), "d/m/Y H:i"); ?></strong></div>
              <div class="repair-detail-item"><span>SLA ครบกำหนด</span><strong><?php echo $rows['sla_due_at'] ? date_format(date_create($rows['sla_due_at']), "d/m/Y H:i") : '-'; ?></strong></div>
            </div>

            <div class="repair-detail-problem">
              <h3>อาการ / รายละเอียดปัญหา</h3>
              <p><?php echo nl2br(htmlspecialchars($rows['r_detail'])); ?></p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-7">
            <div class="box">
              <div class="box-body">
                <div class="repair-section-head">
                  <h3>Timeline งานซ่อม</h3>
                  <p>แสดงเหตุการณ์สำคัญของงานรายการนี้</p>
                </div>
                <div class="repair-timeline">
                  <?php if ($logs && mysqli_num_rows($logs) > 0) { ?>
                    <?php while ($log = mysqli_fetch_array($logs)) { ?>
                      <div class="repair-timeline-item">
                        <div class="repair-timeline-dot"></div>
                        <div class="repair-timeline-content">
                          <div class="repair-timeline-meta">
                            <strong><?php echo $log['action_type'] ? $log['action_type'] : 'status'; ?></strong>
                            <span><?php echo date_format(date_create($log['rlog_save']), "d/m/Y H:i"); ?></span>
                          </div>
                          <p>
                            <?php
                            if ($log['note']) {
                              echo htmlspecialchars($log['note']);
                            } elseif ($log['new_status_name']) {
                              echo 'สถานะปัจจุบัน: ' . htmlspecialchars($log['new_status_name']);
                            } else {
                              echo 'มีการอัปเดตข้อมูล';
                            }
                            ?>
                          </p>
                          <small>ผู้ดำเนินการ: <?php echo $log['actor_name'] ? $log['actor_name'] : '-'; ?></small>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } else { ?>
                    <div class="repair-empty-state">ยังไม่มีประวัติการดำเนินงาน</div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-5">
            <div class="box">
              <div class="box-body">
                <div class="repair-section-head">
                  <h3>เพิ่มหมายเหตุ / แนบไฟล์</h3>
                  <p>ใช้บันทึกความคืบหน้าและเก็บไฟล์ประกอบงานซ่อม</p>
                </div>
                <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>หมายเหตุ</label>
                    <textarea name="comment_text" class="form-control" rows="5" placeholder="บันทึกการตรวจสอบหรือความคืบหน้าของงาน"></textarea>
                  </div>
                  <div class="form-group">
                    <label>แนบไฟล์</label>
                    <input type="file" name="attachment" class="form-control">
                  </div>
                  <button type="submit" name="btnAddRepairNote" class="btn btn-primary">
                    <i class="fa fa-save"></i> บันทึกหมายเหตุ
                  </button>
                </form>
              </div>
            </div>

            <div class="box">
              <div class="box-body">
                <div class="repair-section-head">
                  <h3>ไฟล์แนบ</h3>
                  <p>ไฟล์หรือรูปที่แนบกับงานซ่อมนี้</p>
                </div>
                <div class="repair-attachment-list">
                  <?php if ($attachments && mysqli_num_rows($attachments) > 0) { ?>
                    <?php while ($attachment = mysqli_fetch_array($attachments)) { ?>
                      <a class="repair-attachment-item" href="<?php echo htmlspecialchars($attachment['file_path']); ?>" target="_blank">
                        <div>
                          <strong><?php echo htmlspecialchars($attachment['file_name']); ?></strong>
                          <small>โดย <?php echo $attachment['uploader_name'] ? $attachment['uploader_name'] : '-'; ?></small>
                        </div>
                        <span><?php echo date_format(date_create($attachment['uploaded_at']), "d/m/Y H:i"); ?></span>
                      </a>
                    <?php } ?>
                  <?php } else { ?>
                    <div class="repair-empty-state">ยังไม่มีไฟล์แนบ</div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="box-body">
            <div class="repair-section-head">
              <h3>หมายเหตุทั้งหมด</h3>
              <p>บันทึกที่เกี่ยวข้องกับงานซ่อมรายการนี้</p>
            </div>
            <div class="repair-comment-list">
              <?php if ($comments && mysqli_num_rows($comments) > 0) { ?>
                <?php while ($comment = mysqli_fetch_array($comments)) { ?>
                  <div class="repair-comment-item">
                    <div class="repair-comment-top">
                      <strong><?php echo $comment['commenter_name'] ? $comment['commenter_name'] : 'ผู้ใช้งาน'; ?></strong>
                      <span><?php echo date_format(date_create($comment['created_at']), "d/m/Y H:i"); ?></span>
                    </div>
                    <p><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></p>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="repair-empty-state">ยังไม่มีหมายเหตุในงานนี้</div>
              <?php } ?>
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
<?php mysqli_close($conn); ?>
