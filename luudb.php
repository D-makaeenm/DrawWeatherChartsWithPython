<?php
    $serverName = "DUYVPRO";  // Tên máy chủ SQL Server
    $connectionOptions = array(
        "Database" => "thaycop",  // Tên cơ sở dữ liệu
        "Uid" => "sa",  // Tên người dùng SQL Server
        "PWD" => "makaeenm1"  // Mật khẩu SQL Server
    );
    
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    
    if ($conn === false) {
        die( print_r( sqlsrv_errors(), true));
    }
    $sql = "INSERT INTO thoi_tiet (City, Date, Temperature, Humidity, Pressure, Rain, WindSpeed) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $params = array('Thai Nguyen', '2024-05-12', 25.5, 80, 1013.2, 0, 3.2);  // Thay thế các giá trị thích hợp tùy thuộc vào dữ liệu thời tiết bạn có

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die( print_r( sqlsrv_errors(), true));
    }
?>