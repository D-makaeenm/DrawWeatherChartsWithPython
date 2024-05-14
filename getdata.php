<?php
// Kết nối đến cơ sở dữ liệu
$serverName = "DUYVPRO";
$connectionOptions = array(
    "Database" => "thaycop",
    "Uid" => "sa",
    "PWD" => "makaeenm1"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Kiểm tra kết nối
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Gọi stored procedure
$sql = "{CALL GetThoiTietData}";
$stmt = sqlsrv_query($conn, $sql);

// Kiểm tra và xử lý kết quả
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    $result = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $result[] = $row;
    }
    
    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($result);
}

// Đóng kết nối
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
