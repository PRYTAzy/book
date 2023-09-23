<?php
if (isset($conn)) {
    mysqli_close($conn);
    unset($sql, $result, $record, $conn);
}
?>