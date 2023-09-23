<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connect.php");

    // รับข้อมูลจากแบบฟอร์ม
    $mid = $_POST["mid"];
    $mname = $_POST["mname"];
    $mdep = $_POST["mdep"];

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO members (mid, mname, mdep) VALUES ('$mid', '$mname', '$mdep')";
    
    if (mysqli_query($conn, $sql)) {
        echo "เพิ่มรายชื่อสมาชิกเรียบร้อยแล้ว";
        
        // เปลี่ยนเส้นทางไปยังหน้า mbr_list.php หลังจากเพิ่มสมาชิกเรียบร้อยแล้ว
        header("Location: http://localhost/library/mbr_list.php?keyword=&submit=OK");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มรายชื่อสมาชิก: " . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>เพิ่มรายชื่อสมาชิก</title>
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

        form {
            text-align: left;
            margin: 0 auto;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
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
        <h1>เพิ่มรายชื่อสมาชิก</h1>
        <form action="process_add_member.php" method="post">
            <label for="mid">รหัสนักศึกษา :</label>
            <input type="text" name="mid" id="mid" required>

            <label for="mname">ชื่อ - นามสกุล :</label>
            <input type="text" name="mname" id="mname" required>

            <label for="mdep">ชื่อสาขาวิชา :</label>
            <input type="text" name="mdep" id="mdep" required>

            <input type="submit" name="submit" value="เพิ่มรายชื่อ">
        </form>
    </main>
</body>
</html>
<script>
    // ตรวจสอบข้อมูลซ้ำทันทีหลังจากกด Submit
    function checkDuplicate() {
        var mid = document.getElementById('mid').value;
        var request = new XMLHttpRequest();
        request.open('GET', 'check_duplicate.php?mid=' + mid, true);
        request.onreadystatechange = function() {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText === 'duplicate') {
                    alert('ข้อมูลรหัสนี้มีอยู่แล้วในระบบ');
                }
            }
        };
        request.send();
    }
</script>
