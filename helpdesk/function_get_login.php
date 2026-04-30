<?php
	function get_browser_name($user_agent)
	{
	    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
	    else if (strpos($user_agent, 'Edge')) return 'Edge';
	    else if (strpos($user_agent, 'Chrome')) return 'Chrome';
	    else if (strpos($user_agent, 'Safari')) return 'Safari';
	    else if (strpos($user_agent, 'Firefox')) return 'Firefox';
	    else if (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';	    
	    return 'Other';
	}
	
	
	$u_idcard = $_SESSION['u_idcard'];
	$log_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$log_ip = $_SERVER['REMOTE_ADDR'];
	$log_browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
	$log_save = date('Y-m-d H:i:s');
	
	$sqllog1 = "INSERT INTO tb_login_log(u_idcard,log_host,log_ip,log_browser,log_save) VALUES('$u_idcard','$log_host','$log_ip','$log_browser','$log_save')";
	$querylog1 = mysqli_query($conn, $sqllog1);
?>