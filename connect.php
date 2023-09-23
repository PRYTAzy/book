<?php
// ค่าการเชื่อมต่อฐานข้อมูล
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "library";

// คำสั่งการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// ตั้งค่าภาษาเป็น utf8
mysqli_query($conn, "SET NAMES utf8");
?>
