<?php
require("mysql/config.php");

// ตรวจสอบว่ามีการส่งรหัสนักศึกษามาหรือไม่
if (isset($_GET['mid'])) {
    $mid = $_GET['mid'];

    // ค้นหาข้อมูลสมาชิกจากฐานข้อมูล
    $sql = "SELECT * FROM members WHERE mid='$mid'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    // ตรวจสอบว่าพบข้อมูลสมาชิกหรือไม่
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $mname = $row['mname'];
        $mdep = $row['mdep'];
    } else {
        echo "ไม่พบข้อมูลสมาชิกที่คุณเรียก";
        exit;
    }
} else {
    echo "ไม่ได้ระบุรหัสนักศึกษา";
    exit;
}

// ดักเหตุการณ์การบันทึกข้อมูลที่ถูกแก้ไข
if (isset($_POST['update'])) {
    $mname = $_POST['mname'];
    $mdep = $_POST['mdep'];

    // ตรวจสอบความถูกต้องของข้อมูลที่รับมาจากฟอร์ม
    if (empty($mname) || empty($mdep)) {
        $errorMsg = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    } else {
        // ทำการอัปเดตข้อมูลสมาชิกในฐานข้อมูล
        $sql = "UPDATE members SET mname='$mname', mdep='$mdep' WHERE mid='$mid'";
        $updateResult = mysqli_query($conn, $sql);

        if (!$updateResult) {
            die("Error: " . mysqli_error($conn));
        } else {
            $successMsg = "อัปเดตข้อมูลสมาชิกเรียบร้อยแล้ว";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสมาชิก - ระบบห้องสมุด</title>
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
		.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
}

/* เมื่อนำเมาส์มาชี้ที่ปุ่ม */
.back-button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
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
    <h1>แก้ไขข้อมูลสมาชิก</h1>

    <!-- แสดงข้อความข้อผิดพลาดหรือข้อความสำเร็จ (ถ้ามี) -->
    <?php if (isset($errorMsg)) : ?>
        <p style="color: red;"><?php echo $errorMsg; ?></p>
    <?php endif; ?>
    <?php if (isset($successMsg)) : ?>
        <p style="color: green;"><?php echo $successMsg; ?></p>
    <?php endif; ?>

    <!-- ฟอร์มแก้ไขข้อมูลสมาชิก -->
    <form action="mbr_edit.php?mid=<?php echo $mid; ?>" method="POST">
        <label for="mname">ชื่อ:</label>
        <input type="text" id="mname" name="mname" value="<?php echo $mname; ?>" required><br>

        <label for="mdep">สาขาวิชา:</label>
        <input type="text" id="mdep" name="mdep" value="<?php echo $mdep; ?>" required><br>

        <input type="submit" name="update" value="บันทึกข้อมูล">
    </form>

	<n><p><a class="back-button" href="mbr_detail.php?mid=<?php echo $mid; ?>">กลับไปยังหน้ารายชื่อสมาชิก</a></p></n>


</main>

    <footer>
        <!-- เพิ่มเนื้อหาส่วนท้ายเว็บไซต์ (footer) ตามความต้องการ -->
    </footer>
</body>
</html>