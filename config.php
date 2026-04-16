<?php
$host = 'database-1.c4ezxxzn5m2w.us-west-2.rds.amazonaws.com';
$db   = 'coffee_shop_db';
$user = 'admin';
$pass = 'SalamADBJuara';
$charset = 'utf8mb4';
$port = 3306;

// Menambahkan opsi koneksi SSL karena error AWS RDS sebelumnya
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // Lewatkan sertifikat CA AWS strict
];

$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     http_response_code(500);
     echo json_encode(['error' => 'Gagal konek DB: ' . $e->getMessage()]);
     exit;
}
?>
