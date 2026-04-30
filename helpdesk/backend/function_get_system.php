<?php
include_once(__DIR__ . '/action/repair_tracking_helper.php');

if (!function_exists('get_browser_name')) {
	function get_browser_name($user_agent)
	{
		if (strpos($user_agent, 'Opera') !== false || strpos($user_agent, 'OPR/') !== false) {
			return 'Opera';
		}
		if (strpos($user_agent, 'Edge') !== false) {
			return 'Edge';
		}
		if (strpos($user_agent, 'Chrome') !== false) {
			return 'Chrome';
		}
		if (strpos($user_agent, 'Safari') !== false) {
			return 'Safari';
		}
		if (strpos($user_agent, 'Firefox') !== false) {
			return 'Firefox';
		}
		if (strpos($user_agent, 'MSIE') !== false || strpos($user_agent, 'Trident/7') !== false) {
			return 'Internet Explorer';
		}

		return 'Other';
	}
}

$user_id = isset($record['u_idcard']) ? $record['u_idcard'] : '';
$rlog_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$rlog_ip = $_SERVER['REMOTE_ADDR'];
$rlog_browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
$rlog_save = date('Y-m-d H:i:s');
$action_type = isset($action_type) ? $action_type : null;
$old_s_id = isset($old_s_id) ? $old_s_id : null;
$log_note = isset($log_note) ? $log_note : null;

repairInsertLog(
	$conn,
	$r_no,
	$s_id,
	$technician_id,
	$user_id,
	$rlog_host,
	$rlog_ip,
	$rlog_browser,
	$rlog_save,
	$action_type,
	$old_s_id,
	$log_note
);
?>
