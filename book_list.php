<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายชื่อหนังสือ - ระบบห้องสมุด</title>
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

        .hero-button {
            margin-top: 20px;
        }

        /* สไตล์ของปุ่มในหน้าจัดการสมาชิก */
        .mbr-list-button {
            margin-top: 20px;
        }

        /* สไตล์ของปุ่มในหน้ารายชื่อหนังสือ */
        .book-list-button {
            margin-top: 20px;
        }

        /* ส่วน CSS สำหรับเพิ่มเอฟเฟกต์ hover และปรับแต่งแถบเมนู */
        nav ul li {
            position: relative; /* เพิ่มองค์ประกอบแสดงออกเมื่อชี้ */
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            position: relative;
            transition: 0.3s; /* เพิ่มการแปลงเวลาเมื่อ hover */
        }

        /* เมื่อเมาส์ชี้ที่ลิงก์ */
        nav ul li a:hover {
            top: -3px; /* ย้ายขึ้นเล็กน้อยเมื่อ hover */
        }

        /* สไตล์ของปุ่มค้นหา */
        .btn-search {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-search:hover {
            background-color: #555;
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
    <main>
        <form action="book_list.php" method="get" target="_self">
            <label for="keyword">Search :</label>
            <input type="text" name="keyword" id="keyword" value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
            <input type="submit" name="submit" value="ค้นหา" class="btn-search">
        </form>
        
<?php
$found = false; // เพิ่มตัวแปร $found ด้วยค่าเริ่มต้นเป็น false

if (isset($_GET['submit']) && $_GET['submit'] === 'ค้นหา' && isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql = "SELECT bid, btitle, bcate FROM books WHERE bid='$keyword' OR btitle LIKE '%$keyword%'";
    require("mysql/connect.php");

    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $found = true;
    }
} else {
    // ถ้าไม่มีการกด Submit หรือไม่มี Keyword ให้แสดงรายชื่อทั้งหมด
    $sql = "SELECT bid, btitle, bcate FROM books";
    require("mysql/connect.php");

    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $found = true;
    }
}
?>
<h1>รายชื่อหนังสือ</h1>
<table>
    <tr>
        <th>รหัสหนังสือ</th>
        <th>ชื่อหนังสือ</th>
        <th>ประเภทหนังสือ</th>
    </tr>
    <?php
    // เชื่อมต่อฐานข้อมูล
    require("mysql/connect.php");

    if ($found) {
        // แสดงผลลัพธ์การค้นหาหากพบข้อมูล
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["bid"] . "</td>";
            echo "<td>" . $row["btitle"] . "</td>";
            echo "<td>" . $row["bcate"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>ไม่พบรายชื่อหนังสือ</td></tr>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
    ?>
</table>
    </main>
</body>
</html>
