<?php

if (!function_exists('repairEscape')) {
	function repairEscape($conn, $value)
	{
		return mysqli_real_escape_string($conn, trim((string) $value));
	}
}

if (!function_exists('repairLimit')) {
	function repairLimit($value, $length)
	{
		$value = trim((string) $value);
		if (strlen($value) <= $length) {
			return $value;
		}

		return substr($value, 0, $length);
	}
}

if (!function_exists('repairGetStatusName')) {
	function repairGetStatusName($conn, $statusId)
	{
		$statusId = repairEscape($conn, $statusId);
		$sql = "SELECT s_status FROM tb_status WHERE s_id = '$statusId' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			return $row['s_status'];
		}

		return '';
	}
}

if (!function_exists('repairGetCurrentRepairRow')) {
	function repairGetCurrentRepairRow($conn, $rNo)
	{
		$rNo = repairEscape($conn, $rNo);
		$sql = "SELECT * FROM tb_repair WHERE r_no = '$rNo' LIMIT 1";
		$query = mysqli_query($conn, $sql);

		if ($query && mysqli_num_rows($query) > 0) {
			return mysqli_fetch_assoc($query);
		}

		return null;
	}
}

if (!function_exists('repairCalculateSlaDueAt')) {
	function repairCalculateSlaDueAt($conn, $eqId, $wlId, $fromDate)
	{
		$eqId = (int) $eqId;
		$wlId = repairEscape($conn, $wlId);
		$sql = "SELECT resolve_hours
		        FROM tb_sla_rule
		        WHERE eq_id = $eqId AND wl_id = '$wlId' AND is_active = '1'
		        ORDER BY sla_id ASC
		        LIMIT 1";
		$query = mysqli_query($conn, $sql);

		$resolveHours = 24;
		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$resolveHours = max(1, (int) $row['resolve_hours']);
		}

		return date('Y-m-d H:i:s', strtotime($fromDate . " +{$resolveHours} hours"));
	}
}

if (!function_exists('repairInsertLog')) {
	function repairInsertLog($conn, $rNo, $statusId, $technicianId, $userId, $host, $ip, $browser, $savedAt, $actionType = null, $oldStatusId = null, $note = null)
	{
		$rNo = repairEscape($conn, $rNo);
		$statusId = repairEscape($conn, $statusId);
		$technicianId = repairEscape($conn, $technicianId);
		$userId = repairEscape($conn, $userId);
		$host = repairEscape($conn, repairLimit($host, 100));
		$ip = repairEscape($conn, repairLimit($ip, 100));
		$browser = repairEscape($conn, repairLimit($browser, 100));
		$savedAt = repairEscape($conn, $savedAt);
		$actionTypeSql = $actionType !== null ? "'" . repairEscape($conn, repairLimit($actionType, 50)) . "'" : "NULL";
		$oldStatusSql = $oldStatusId !== null && $oldStatusId !== '' ? "'" . repairEscape($conn, $oldStatusId) . "'" : "NULL";
		$noteSql = $note !== null && $note !== '' ? "'" . repairEscape($conn, repairLimit($note, 1000)) . "'" : "NULL";

		$sql = "INSERT INTO tb_repair_log(
					r_no, action_type, old_s_id, s_id, technician_id, user_id, note, rlog_host, rlog_ip, rlog_browser, rlog_save
				) VALUES (
					'$rNo', $actionTypeSql, $oldStatusSql, '$statusId', '$technicianId', '$userId', $noteSql, '$host', '$ip', '$browser', '$savedAt'
				)";

		return mysqli_query($conn, $sql);
	}
}

if (!function_exists('repairInsertComment')) {
	function repairInsertComment($conn, $rNo, $userId, $commentText, $commentType = 'comment')
	{
		$commentText = trim((string) $commentText);
		if ($commentText === '') {
			return false;
		}

		$rNo = repairEscape($conn, $rNo);
		$userId = repairEscape($conn, $userId);
		$commentText = repairEscape($conn, $commentText);
		$commentType = repairEscape($conn, $commentType);

		$sql = "INSERT INTO tb_repair_comment(r_no, user_id, comment_text, comment_type, created_at)
		        VALUES('$rNo', '$userId', '$commentText', '$commentType', NOW())";

		return mysqli_query($conn, $sql);
	}
}

if (!function_exists('repairInsertAssignmentHistory')) {
	function repairInsertAssignmentHistory($conn, $rNo, $fromUserId, $toUserId, $assignedBy, $assignNote = null)
	{
		$rNo = repairEscape($conn, $rNo);
		$fromUserSql = $fromUserId !== null && $fromUserId !== '' ? "'" . repairEscape($conn, $fromUserId) . "'" : "NULL";
		$toUserId = repairEscape($conn, $toUserId);
		$assignedBy = repairEscape($conn, $assignedBy);
		$assignNoteSql = $assignNote !== null && $assignNote !== '' ? "'" . repairEscape($conn, $assignNote) . "'" : "NULL";

		$sql = "INSERT INTO tb_assignment_history(r_no, from_user_id, to_user_id, assigned_by, assign_note, assigned_at)
		        VALUES('$rNo', $fromUserSql, '$toUserId', '$assignedBy', $assignNoteSql, NOW())";

		return mysqli_query($conn, $sql);
	}
}

if (!function_exists('repairInsertNotification')) {
	function repairInsertNotification($conn, $userId, $rNo, $title, $message)
	{
		$userId = trim((string) $userId);
		if ($userId === '') {
			return false;
		}

		$userId = repairEscape($conn, $userId);
		$rNoSql = $rNo !== null && $rNo !== '' ? "'" . repairEscape($conn, $rNo) . "'" : "NULL";
		$title = repairEscape($conn, $title);
		$message = repairEscape($conn, $message);

		$sql = "INSERT INTO tb_notification(user_id, r_no, title, message, is_read, created_at)
		        VALUES('$userId', $rNoSql, '$title', '$message', '0', NOW())";

		return mysqli_query($conn, $sql);
	}
}

if (!function_exists('repairHandleAttachmentUpload')) {
	function repairHandleAttachmentUpload($conn, $fileInputName, $rNo, $uploadedBy)
	{
		if (!isset($_FILES[$fileInputName]) || !is_array($_FILES[$fileInputName])) {
			return null;
		}

		$file = $_FILES[$fileInputName];
		if ((int) $file['error'] !== UPLOAD_ERR_OK || (int) $file['size'] <= 0) {
			return null;
		}

		$uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'repair_attachments';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		$originalName = $file['name'];
		$extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
		$safeBaseName = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
		$safeBaseName = trim($safeBaseName, '_');
		if ($safeBaseName === '') {
			$safeBaseName = 'file';
		}

		$storedName = $rNo . '_' . date('YmdHis') . '_' . mt_rand(1000, 9999) . '_' . $safeBaseName;
		if ($extension !== '') {
			$storedName .= '.' . $extension;
		}

		$absolutePath = $uploadDir . DIRECTORY_SEPARATOR . $storedName;
		$relativePath = 'uploads/repair_attachments/' . $storedName;

		if (!move_uploaded_file($file['tmp_name'], $absolutePath)) {
			return false;
		}

		$rNo = repairEscape($conn, $rNo);
		$originalName = repairEscape($conn, $originalName);
		$relativePath = repairEscape($conn, $relativePath);
		$extension = repairEscape($conn, $extension);
		$fileSize = (int) $file['size'];
		$uploadedBy = repairEscape($conn, $uploadedBy);

		$sql = "INSERT INTO tb_repair_attachment(r_no, file_name, file_path, file_ext, file_size, uploaded_by, uploaded_at)
		        VALUES('$rNo', '$originalName', '$relativePath', '$extension', $fileSize, '$uploadedBy', NOW())";

		mysqli_query($conn, $sql);

		return $relativePath;
	}
}
