<?php
header('Content-Type: application/json');

// Memasukkan koneksi dari file config.php
require_once 'config.php';

// Menangkap jenis request (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Mengambil parameter '?id=' dari URL jika ada
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

try {
    switch ($method) {
        
        // 1. READ (SELECT)
        case 'GET':
            $stmt = $pdo->query("SELECT * FROM menus ORDER BY id DESC");
            $menus = $stmt->fetchAll();
            echo json_encode($menus);
            break;

        // 2. CREATE (INSERT)
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("INSERT INTO menus (name, category, price) VALUES (:name, :category, :price)");
            $stmt->execute([
                'name' => $data['name'],
                'category' => $data['category'],
                'price' => $data['price']
            ]);
            // Kembalikan metadata json yang sama dengan versi Express
            echo json_encode(['id' => $pdo->lastInsertId(), 'message' => 'Menu berhasil ditambahkan']);
            break;

        // 3. UPDATE (UPDATE)
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            if ($id) {
                $stmt = $pdo->prepare("UPDATE menus SET name = :name, category = :category, price = :price WHERE id = :id");
                $stmt->execute([
                    'id' => $id,
                    'name' => $data['name'],
                    'category' => $data['category'],
                    'price' => $data['price']
                ]);
                echo json_encode(['message' => 'Menu berhasil diubah']);
            } else {
                echo json_encode(['error' => 'ID wajib disertakan saat mengedit data']);
            }
            break;

        // 4. DELETE (DELETE)
        case 'DELETE':
            if ($id) {
                $stmt = $pdo->prepare("DELETE FROM menus WHERE id = :id");
                $stmt->execute(['id' => $id]);
                echo json_encode(['message' => 'Menu berhasil dihapus']);
            } else {
                echo json_encode(['error' => 'ID wajib disertakan saat menghapus data']);
            }
            break;

        // Proteksi route
        default:
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Metode HTTP ' . $method . ' tidak didukung di endpoint ini.']);
            break;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Terjadi kesalahan kueri pada database MariaDB/MySQL',
        'detail' => $e->getMessage()
    ]);
}
?>
