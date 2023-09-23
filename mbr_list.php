<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายชื่อสมาชิก - ระบบห้องสมุด</title>
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

        /* สไตล์ของปุ่มเพิ่มสมาชิก */
        .btn-add-member {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-add-member:hover {
            background-color: #45a049;
        }

        /* สไตล์ของปุ่ม "ดูรายระเอียด" */
        .btn-view-details {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-view-details:hover {
            background-color: #0056b3;
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
		        .btn-1 {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: block; /* เปลี่ยนเป็น block แทน inline-block */
            font-size: 16px;
            margin: 0 auto; /* จัดให้ปุ่มอยู่ตรงกลาง */
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s; /* เพิ่ม transition เมื่อ hover  */
        }

        /* เมื่อ hover ปุ่มเปลี่ยนสีพื้นหลัง */
        .btn-1:hover {
            background-color: #45a049;
            transform: scale(1.05); /* เพิ่ม scale เมื่อ hover */
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
        <form action="mbr_list.php" method="get" target="_self">
            <label for="keyword">Search :</label>
            <input type="text" name="keyword" id="keyword" value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
            <input type="submit" name="submit" value="ค้นหา" class="btn-search">
        </form>

        <button class="btn-1 btn-add-member" onclick="window.location.href='add_member.php'">เพิ่มรายชื่อสมาชิก</button>

        <?php
        $found = false; // เพิ่มตัวแปร $found ด้วยค่าเริ่มต้นเป็น false

        if (isset($_GET['submit']) && $_GET['submit'] === 'ค้นหา' && isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $sql = "SELECT mid, mname, mdep FROM members WHERE mid='$keyword' OR mname LIKE '%$keyword%'";
            require("mysql/connect.php");

            // ตรวจสอบว่ามีผลลัพธ์หรือไม่
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $found = true;
            }
        } else {
            // ถ้าไม่มีการกด Submit หรือไม่มี Keyword ให้แสดงรายชื่อทั้งหมด
            $sql = "SELECT mid, mname, mdep FROM members";
            require("mysql/connect.php");

            // ตรวจสอบว่ามีผลลัพธ์หรือไม่
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $found = true;
            }
        }
        ?>
        <h1>รายชื่อสมาชิก</h1>

        <?php
        if ($found) {
            echo '<table border="1" cellspacing="0" cellpadding="2">';
            echo '<tr>';
            echo '<td><center>รหัสนักศึกษา</center></td>';
            echo '<td><center>ชื่อ - นามสกุล</center></td>';
            echo '<td><center>สาขาวิชาของนักศึกษา</center></td>';
            echo '<td><center>การจัดการ</center></td>';
            echo '</tr>';
            while ($record = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $record[0] . '</td>';
                echo '<td>' . $record[1] . '</td>';
                echo '<td>' . $record[2] . '</td>';
                echo '<td><center><a href="mbr_detail.php?mid=' . $record[0] . '" class="btn-view-details">ดูรายระเอียด</a></center></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>ไม่พบรายชื่อที่ต้องการค้นหา</p>';
        }
        ?>
    </main>
</body>
</html>