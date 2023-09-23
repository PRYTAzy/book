<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายการหนังสือที่กำลังยืม</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
		/* สไตล์ของปุ่มคืนหนังสือ */
.payment-button {
    background-color: #29a6ff; /* สีพื้นหลังปุ่ม */
    color: #fff; /* สีข้อความ */
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 2px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.payment-button:hover {
    background-color: #218838; /* สีพื้นหลังเมื่อ hover */
}
    </style>
</head>
<h1>หนังสือที่ผู้ใช้รายนี้คืนไม่ทัน</h1>
<table border="1" cellspacing="0" cellpadding="2">
  <tr>
    <td>Book ID</td>
    <td>ชื่อหนังสือ</td>
    <td>วันที่ยืม</td>
    <td>ควรคืนก่อนวันที่</td>
    <td>ให้คืนวันที่</td>
    <td align="center">คืนช้า</td>
    <td align="center">ค่าปรับ 5 บาท / วัน</td>
    <td align="center">จ่าย</td>
  </tr>
<?php
// เชื่อมต่อกับฐานข้อมูล
require('mysql/connect.php');

// สร้างคำสั่ง SQL
$sql = "SELECT books.bid, books.btitle, transections.tlend,
  DATE_ADD(transections.tlend, INTERVAL 7 DAY) AS deadline,
  transections.trest,
  DATEDIFF(transections.trest, transections.tlend)-7 AS late
  FROM books, transections
  WHERE books.bid=transections.bid
  AND transections.mid='$mid'
  AND transections.tstat='2'";

// ส่งคำสั่ง SQL ไปที่ฐานข้อมูล
$result = mysqli_query($conn, $sql);

// ตรวจสอบข้อผิดพลาดในการส่งคำสั่ง SQL
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>
  <?php
  while($record = mysqli_fetch_array($result)){
  ?>
  <tr>
    <td><?php echo($record[0]);?></td>
    <td><?php echo($record[1]);?></td>
    <td><?php echo($record['tlend']);?></td>
    <td><?php echo($record['deadline']);?></td>
    <td><?php echo($record['trest']);?></td>
    <td>คืนช้า <?php echo($record[5]);?> วัน</td>
    <td>ต้องจ่ายค่าปรับ <?php echo((int)$record[5] * 5);?> บาท</td>
<td>
    <a href="javascript:fnekeep('<?php echo($record[0]);?>','<?php echo($record['tlend']);?>')" class="payment-button">จ่ายค่าปรับ</a>
</td>

  </tr>
  <?php
 }
 ?>
</table>
<script language="javascript">
function fnekeep(v1,v2){
    var url = "fne_keep.php?mid=<?php echo($mid);?>&bid=" + v1 + "&tlend=" + v2;
    if(confirm("คุณต้องการจ่ายค่าปรับใช่มั้ย?")==true){
        window.location.href=url;
    }
}
</script>