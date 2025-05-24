<?php
require_once 'commons/env.php';

$conn = getDBConnection();
if ($conn) {
    echo "Kết nối database thành công!";
    $conn->close();
} else {
    echo "Kết nối thất bại!";
}
?>