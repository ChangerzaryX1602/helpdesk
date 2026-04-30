
<?php
$conn = new mysqli("localhost","root","","helpdeskv1");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}else{
	$sqlcom = "SELECT * FROM tb_company LIMIT 1";
	$querycom = mysqli_query($conn, $sqlcom);
	$rowcom = mysqli_fetch_array($querycom);
	$title = $rowcom['cmp_software'];
}
?>