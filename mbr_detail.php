<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก - ระบบห้องสมุด</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
    }

    nav {
        text-align: right;
        padding: 10px 20px;
    }

    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
        position: relative;
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        position: relative;
        transition: 0.3s;
    }

    nav ul li a:hover {
        top: -3px;
    }

    main {
        padding: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
        text-align: left;
    }

    th, td {
        padding: 8px;
    }

    footer {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        text-align: center;
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .btn-1 {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: block;
        font-size: 16px;
        margin: 0 auto;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-1:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }

    .hero-button {
        margin-top: 20px;
    }

    .mbr-list-button,
    .book-list-button {
        margin-top: 20px;
    }
	.edit-button {
    background-color: #007bff; /* สีพื้นหลังปุ่ม */
    color: #fff; /* สีข้อความ */
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 0 auto;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.edit-button:hover {
    background-color: #0056b3; /* สีพื้นหลังเมื่อ hover */
}
</style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="mbr_list.php">จัดการสมาชิก</a></li>
                <li><a href="book_list.php">รายชื่อหนังสือ</a></li>
            </ul>
        </nav>
    </header>
<?php
require("mysql/config.php");
$mid=$_GET['mid'];
require("mbr_select.php");

// ดักเหตุการณ์คืนหนังสือ
if(isset($_GET['return_book']) && isset($_GET['bid'])){
    $return_book = $_GET['return_book'];
    $bid = $_GET['bid'];

    // เรียกใช้ PHP script ที่เกี่ยวข้องกับการคืนหนังสือ
    // ตามโค้ดของ rst_save.php
    require("rst_save.php");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Detail</title>
</head>

<body>
<table width="64%" border="0" cellpadding="5" cellspacing="0" style="margin: 20px auto; border-collapse: collapse; background-color: #fff;">
  <tr>
    <td colspan="2" align="center" style="background-color: #333; color: #fff; padding: 10px;"><strong>ข้อมูลของผู้ใช้งาน : <?php echo($mname);?></strong></td>
  </tr>
  <tr>
    <td align="right" style="padding: 5px;"><strong>รหัสนักศึกษา :</strong></td>
    <td align="left" style="padding: 5px;"><?php echo($mid);?></td>
  </tr>
  <tr>
    <td align="right" style="padding: 5px;"><strong>ชื่อ :</strong></td>
    <td align="left" style="padding: 5px;"><?php echo($mname);?></td>
  </tr>
  <tr>
    <td align="right" style="padding: 5px;"><strong>สาขาวิชา :</strong></td>
    <td align="left" style="padding: 5px;"><?php echo($mdep);?></td>
  </tr>
<td colspan="2" align="center">
    <a href="mbr_list.php" style="display: inline-block; padding: 10px 20px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px;">ย้อนกลับ</a>
    <a href="mbr_edit.php?mid=<?php echo($mid);?>" class="edit-button">แก้ไขข้อมูลสมาชิก</a>

</td>
</table><br />

<!-- แสดงฟอร์มสำหรับยืมหนังสือ -->
<?php require("brw_form.php"); ?><br />

<!-- แสดงรายการหนังสือที่กำลังยืม -->
<?php require("brw_list.php"); ?><br />

<!-- แสดงรายการหนังสือที่ควรคืน -->
<?php require("fne_list.php"); ?><br />

</body>
</html>