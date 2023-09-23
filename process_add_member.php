<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connect.php");

    // รับข้อมูลจากแบบฟอร์ม
    $mid = $_POST["mid"];
    $mname = $_POST["mname"];
    $mdep = $_POST["mdep"];

    // ตรวจสอบว่าข้อมูลซ้ำหรือไม่
    $check_sql = "SELECT COUNT(*) FROM members WHERE mid = '$mid'";
    $result = mysqli_query($conn, $check_sql);
    $row = mysqli_fetch_array($result);

    if ($row[0] > 0) {
        echo "ข้อมูลรหัสนี้มีอยู่แล้วในระบบ";
    } else {
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO members (mid, mname, mdep) VALUES ('$mid', '$mname', '$mdep')";
        if (mysqli_query($conn, $sql)) {
            // เพิ่มสมาชิกเรียบร้อยแล้ว และเปลี่ยนเส้นทาง URL ไปยังหน้า mbr_list.php
            header("Location: mbr_list.php?keyword=&submit=OK");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มรายชื่อสมาชิก: " . mysqli_error($conn);
        }
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    mysqli_close($conn);
}
?>
