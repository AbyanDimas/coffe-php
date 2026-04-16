# ☕ Coffee Shop CRUD - Versi PHP Asli

Berbeda dari proyek sebelah yang harus ditenagai mesin Node.js, aplikasi ini murni dibangun menggunakan **PHP Murni (PDO API) dan Vanilla JavaScript**. Proyek ini bisa langsung dicemplungkan ke dalam _htdocs_ XAMPP atau folder root web server Apache/Nginx.

## 🛠️ Persiapan

1. **Web Server yang ter-install PHP**: (Bila menggunakan Debian, pastikan `apache2`, `php`, `php-mysql`, `php-pdo` sudah terinstall).
2. **Koneksi Database**: Menggunakan database MariaDB/MySQL (Bisa _local_ di Linux atau di AWS RDS seperti yang tersetting secara _.default_).

---

## 🚀 Langkah Menjalankan

### 1. Letakkan Folder Proyek
Pastikan folder `coffee-shop-php` ini diletakkan di dalam folder publik web server Anda. Jika Anda memakai Apache standar di Debian/Linux, lokasinya biasanya di:
```bash
/var/www/html/coffee-shop-php
```

### 2. Atur Koneksi (File `config.php`)
Buka file `config.php` untuk mengubah konfigurasi database bila ada perubahan Server MariaDB/MySQL:
```php
$host = 'database-1.c4ezxxzn5m2w.us-west-2.rds.amazonaws.com';
$db   = 'coffee_shop_db';
$user = 'admin';
$pass = 'RahasiaAnda';
```

### 3. Tes Aplikasi (Akses URL)
Buka browser dan arahkan alamat ke lokasi server Anda beserta nama foldernya.
Bila jalan di lokal tanpa virtual host:
**http://localhost/coffee-shop-php**

Aplikasi CRUD sudah siap menampilkan menu secara serentak karena terhubung dengan MariaDB/MySQL di belakang layar, dan semuanya diproses di atas **Port 80 standar**!
