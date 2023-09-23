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

        /* ข้อมูลเสริมจากหน้า mbr_list.php */
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

    <!-- เนื้อหาหน้าหลัก -->
    <main>
        <!-- ส่วนของหัวข้อและเนื้อหาหน้าหลัก -->
        <h1>ยินดีต้อนรับสู่ระบบห้องสมุด</h1>
        <p>ค้นหาหนังสือ และจัดการสมาชิกได้อย่างง่ายดาย</p>
    </main>

    <!-- ปรับปรุงการจัดวางของปุ่มเพื่อให้อยู่ตรงกลาง -->
    <div style="text-align: center;">
        <button class="btn-1" onclick="window.location.href='mbr_list.php'">ดูรายชื่อสมาชิก</button><p></p>
        <button class="btn-1" onclick="window.location.href='book_list.php'">ดูรายชื่อหนังสือ</button>
        
    </div>

    <!-- ส่วนสุดท้าย -->
<footer>
    <div>&copy; Borrow Books From The University Library</div>
    <div>เว็บไซต์นี้ถูกพัฒนาโดย น้องเงินแสนสุดหล่อโคตรหล่อสุดๆอะจารย์ ♥</div>
</footer>
</body>
</html>