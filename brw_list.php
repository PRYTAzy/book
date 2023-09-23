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
.return-button {
    background-color: #ff5733; /* สีพื้นหลังปุ่ม */
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

.return-button:hover {
    background-color: #218838; /* สีพื้นหลังเมื่อ hover */
}
    </style>
</head>
<h1>ข้อมูลหนังสือที่ผู้ใช้งานยืมไป</h1>
<?php
require('mysql/config.php');

if(isset($_GET['mid'])){
    $mid = $_GET['mid'];
}else{
    $mid = "";
}

$msg = "";
$v1 = 0;

$sql = "SELECT books.bid, books.btitle, transections.tlend,
    DATE_ADD(transections.tlend, INTERVAL 7 DAY) AS deadline
    FROM books, transections
    WHERE books.bid=transections.bid
    AND transections.mid='$mid'
    AND transections.tstat='1'";

require('mysql/connect.php');

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("เกิดข้อผิดพลาดในการคิวรี: " . mysqli_error($conn));
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายการหนังสือที่กำลังยืม</title>
</head>
<body>
<table border="1" cellspacing="0" cellpadding="2">
  <tr>
    <td>Book ID</td>
    <td align="center">ชื่อหนังสือ</td>
    <td align="center">ยืมวันที่</td>
    <td align="center">ควรคืนก่อนวันที่</td>
    <td align="center">คืน</td>
  </tr>
<?php
while ($record = mysqli_fetch_array($result)) {
$tlend = strtotime($record['tlend']);
$deadline = strtotime($record['deadline']);
$currentDate = time();
$daysPassed = floor(($currentDate - $tlend) / (60 * 60 * 24)); // จำนวนวันที่ผ่านไป


    // ตรวจสอบว่าเกินวันกำหนดหรือไม่
    if ($daysPassed > 7) {
        $tstat = 2; // ถ้าเกิน 7 วันให้เปลี่ยนสถานะเป็น 2

        // ทำการปรับค่าตามเงื่อนไข
        $bidToUpdate = $record['bid'];
        $updateSql = "UPDATE transections SET trest=NOW(), tstat='$tstat' WHERE bid='$bidToUpdate' AND mid='$mid' AND tstat='1'";
        $updateResult = mysqli_query($conn, $updateSql);

        if (!$updateResult) {
            die("เกิดข้อผิดพลาดในการปรับปรุงข้อมูล: " . mysqli_error($conn));
        }
    }
    ?>
    <tr>
    <td><?php echo($record['bid']);?></td>
    <td><?php echo($record['btitle']);?> </td>
    <td><?php echo($record['tlend']);?></td>
    <td><?php echo($record['deadline']);?></td>
<td>
    <a href="javascript:rstbook('<?php echo($record['bid']);?>')" class="return-button">คืนหนังสือ</a>
</td>
    </tr>
    <?php
}
?>
</table>
<script language="javascript">
function rstbook(v1) {
    var url = "rst_save.php?mid=<?php echo($mid); ?>&bid=" + v1;
    if (confirm("คุณต้องการคืนหนังสือหรือไม่") == true) {
        window.location.href = url;
    }
}
</script>
</body>
</html>
