<?php
// ==========================================
// PENGATURAN KONTEN & TEMA (SESUAIKAN DI SINI)
// ==========================================

$appName = "Manajemen Menu Coffee Shop";
$appDesc = "Sistem pencatatan daftar menu kopi dan cemilan berbasis PHP dan API.";
$labelForm = "Tambah Menu Baru";

// Pilihan Tema (1 sampai 20)
// 1 = Coffee Classic (Bawaan)  | 11 = Spotify Mode
// 2 = Ocean Glass              | 12 = Muji Japanese
// 3 = Hacker Dark              | 13 = Retro 90s Arcade
// 4 = Matcha Green             | 14 = Barbie Bloom
// 5 = Apple Minimalist         | 15 = Solar Flare Yellow
// 6 = Cyberpunk 2077           | 16 = Discord Aesthetic
// 7 = Sunset Glow              | 17 = Brutalism UI
// 8 = Royal Deep Purple        | 18 = Autumn Leaves
// 9 = Pastel KPop              | 19 = Matrix Console
// 10 = Red Velvet              | 20 = High-End Monotone
$themeMode = 1;

// Pilihan Layout
// 1 = Atas Bawah (Klasik)
// 2 = Split Kiri-Kanan (Seperti Dashboard)
// 3 = Modal/Kompak (Ringing dan Padat)
$layoutMode = 1;


// ==========================================
// KONEKSI DATABASE
// ==========================================
$host = 'database-1.c4ezxxzn5m2w.us-west-2.rds.amazonaws.com';
$db = 'coffee_shop_db';
$user = 'admin';
$pass = 'SalamADBJuara';
$charset = 'utf8mb4';
$port = 3306;

$options = [
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
     PDO::ATTR_EMULATE_PREPARES => false,
     PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, //bypass certif
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