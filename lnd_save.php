<?php
require('mysql/config.php');

if(isset($_POST['mid'])){
	$mid = $_POST['mid'];
} else {
	$mid = "";
}

if(isset($_POST['bid'])){
	$bid = $_POST['bid'];
} else {
	$bid = "";
}

$msg = "";
$v1 = 0;

// เชื่อมต่อฐานข้อมูล
require('mysql/connect.php');

$sql = "SELECT COUNT(bid) FROM books WHERE bid='$bid'";
$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_array($result);
$bookrow = $record[0];

$sql = "SELECT COUNT(bid) FROM transections WHERE bid='$bid' AND mid='$mid' AND tstat='1'";
$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_array($result);
$lending = $record[0];

$sql = "SELECT COUNT(mid) FROM transections WHERE mid='$mid' AND tstat='1'";
$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_array($result);
$holding = $record[0];

if($bookrow < 1){
	$msg = "รหัสหนังสือไม่ถูกต้อง!";
	$v1 = 0;
} elseif($lending > 0){
	$msg = "หนังสือเล่มนี้ถูกสมาชิกรายนี้ยืมอยู่แล้ว";
	$v1 = 0;
} elseif($holding >= 3){
	$msg = "สมาชิกรายนี้ยืมหนังสือเกินจำนวนจำกัดแล้ว";
	$v1 = 0;
} else {
	$sql = "INSERT INTO transections(mid,bid,tlend,tstat) VALUES('$mid','$bid',now(),'1')";
	$result = mysqli_query($conn, $sql);
	if($result){
		$msg = "การยืมหนังสือเสร็จสิ้น!!";
		$v1 = 1;
		// เงื่อนไขที่คุณทำเสร็จสิ้น ให้แสดงข้อความที่นี่
		$holding_msg = "Book Holding: ตอนนี้คุณยืมหนังสือ $holding เล่มแล้ว";
	} else {
		$msg = "การยืมหนังสือเกิดข้อผิดพลาด";
		$v1 = 0;
	}
}

require('mysql/unconn.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การยืมหนังสือ</title>
</head>
<body>
<script language="javascript">
var v1 = <?php echo($v1); ?>;
alert('<?php echo($msg); ?>');
if(v1 == 1){
	window.location.replace("mbr_detail.php?mid=<?php echo($mid); ?>");
} else {
	window.history.back();
}
</script>
</body>
</html>