<!-- <?php
	$conn = mysqli_connect("localhost", "root", "05s@*ass/1", "helpdeskv1") or die("Error Conn" .mysqli_error($conn));
	mysqli_query($conn,"SET NAMES 'UTF8' ");
	date_default_timezone_set("Asia/Bangkok");
	$sqlcom = "SELECT * FROM tb_company LIMIT 1";
	$querycom = mysqli_query($conn, $sqlcom);
	$rowcom = mysqli_fetch_array($querycom);
	$title = $rowcom['cmp_software'];
?> -->
<?php
$mysqli = new mysqli("localhost","my_user","my_password","my_db");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>