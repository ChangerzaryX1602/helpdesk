<?php
session_start();

$r_no = isset($_GET['r_no']) ? $_GET['r_no'] : '';

if ($r_no !== '') {
	header('Location: view_repair.php?r_no=' . urlencode($r_no));
	exit();
}

header('Location: list_repair.php');
exit();
