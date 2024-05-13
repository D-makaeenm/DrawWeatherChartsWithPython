<?php
$url = 'http://127.0.0.1:8000/weather';

// Lấy nội dung từ URL dưới dạng JSON
$response = file_get_contents($url);    

// Kiểm tra nếu có lỗi
if ($response === false) {
    die('Error fetching data');
}

// Decode JSON response
$data = json_decode($response, true);

// Kiểm tra nếu có lỗi trong quá trình decode JSON
if ($data === null) {
    die('Error decoding JSON');
}

// Kết nối đến cơ sở dữ liệu
$serverName = "DUYVPRO";
$connectionOptions = array(
    "Database" => "thaycop",
    "Uid" => "sa",
    "PWD" => "makaeenm1"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die( print_r( sqlsrv_errors(), true));
}

// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng thoi_tiet
$sql = "INSERT INTO thoi_tiet (City, Date, Temperature, Humidity, Pressure) VALUES (?, ?, ?, ?, ?)";

// Lặp qua từng mục trong mảng dữ liệu
foreach ($data as $row) {
    // Thực thi câu lệnh SQL
    $params = array(
        $row['City'],
        $row['Date'],
        $row['Temperature'],
        $row['Humidity'],
        $row['Pressure']
    );
    
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Đóng kết nối đến cơ sở dữ liệu
sqlsrv_close($conn);
?>
