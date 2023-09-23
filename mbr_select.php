<?php
$sql="SELECT mid, mname, mdep FROM members WHERE mid = '$mid'";
require('mysql/connect.php');
$mid = isset($_GET['mid']) ? $_GET['mid'] : '';

if (empty($mid)) {
    echo "ไม่พบรหัสสมาชิกที่ระบุ";
    // สามารถเพิ่มโค้ดเพิ่มเติมเพื่อกำหนดการทำงานเมื่อไม่พบรหัสสมาชิกได้
    exit; // หยุดการทำงานของสคริปต์
}

$sql = "SELECT mid, mname, mdep FROM members WHERE mid = '$mid'";
require('mysql/connect.php');
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "เกิดข้อผิดพลาดในการดึงข้อมูล: " . mysqli_error($conn);
    exit;	
}

$record = mysqli_fetch_array($result);

if (!$record) {
    echo "ไม่พบข้อมูลสมาชิกรหัส $mid";
    exit;
}

$mname = $record[1];
$mdep = $record[2];

require('mysql/unconn.php');
?>