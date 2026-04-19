# Coffee Shop CRUD - PHP Version

Aplikasi ini merupakan sistem CRUD (Create, Read, Update, Delete) yang dibangun menggunakan arsitektur PHP murni (antarmuka PDO) di sisi backend dan Vanilla JavaScript termodularisasi menggunakan sinkronisasi API Fetch di sisi frontend. Sistem dirancang untuk berjalan secara independen pada web server yang mendukung eksekusi PHP (seperti Apache atau Nginx) melalui port 80.

## Kebutuhan Sistem Terkait (Dependencies)

1. **Web Server dan Modul PHP**: Ekosistem utama mewajibkan aktivasi layanan ekstensi PHP untuk mencegah server mengekspos skrip sebagai raw text. Untuk spesifikasi Debian/Ubuntu (termasuk komputasi awan setara AWS EC2), instalasi dilakukan dengan hierarki berikut:
   ```bash
   sudo apt update
   sudo apt install -y php libapache2-mod-php php-mysql
   sudo systemctl restart apache2
   ```
2. **Koneksi Eksternal DBMS**: Instalasi yang disediakan ini secara terpandu mensyaratkan konektivitas MariaDB atau MySQL, baik secara host lokal (127.0.0.1) maupun komputasi awan.

---

## Konfigurasi Arsitektural dan Peluncuran

### 1. Penempatan Direktori Root
Direktori `coffee-shop-php` wajib diletakkan berada di dalam public DocumentRoot pada konfigurasi vhost. Di lingkungan distribusi Linux standar, lokasi hierarkinya berada secara *default* di:
```bash
/var/www/html/coffee-shop-php
```

### 2. Modifikasi Parameter Struktural (`config.php`)
Inti dari pengaturan keseluruhan visual aplikasi dan koneksi basis data bertumpu pada kontrol pusat file `config.php`. Terdapat berbagai deklarasi variabel dinamis yang menimpa kerangka desain.

Konfigurasi Database RDS MySQL / MariaDB:
```php
$host = 'database-1.c4ezxxzn5m2w.us-west-2.rds.amazonaws.com';
$db   = 'coffee_shop_db';
$user = 'admin';
$pass = 'RahasiaSuper';
```

Konfigurasi Tekstual Antarmuka Web:
- `$appName`: Modifikasi string utama header aplikasi.
- `$appDesc`: Modifikasi label sub-header aplikasi.
- `$labelForm`: Mengelola konvensi sintaks judul formulir POST input.

Integrasi Template Antarmuka Dinamis:
- `$themeMode`: Mengatur referensi selektor token CSS dari nilai 1 hingga 20. Terdapat 20 integrasi palet warna visual ranging dari desain Glassmorphism, Brutalism, Apple Minimalist, hingga gaya Cyberpunk tersemat pada `style.css`.
- `$layoutMode`: Mendefinisikan aturan pemecahan tata letak blok CSS Flex/Grid. Input variabel mencakup resolusi model:
   - `1`: Stacked vertical top-down flow (Mode default/klasik).
   - `2`: Split-pane dashboard lateral panel spacing (Memecah layar).
   - `3`: Compact structural grid element flow (Terpusat).

### 3. Eksekusi Akses Rute HTTP
Pada tahap stabilisasi akhir, aplikasi dapat dijangkau dan diproses tanpa sintaks daemon interpreter tersendiri (berbeda dengan node server), dan dijalankan secara asinkron dari browser ke route root web server:
**http://localhost/coffee-shop-php**

Mekanisme REST API internal akan mengeksekusi routing `api.php?id=` melalui Fetch API untuk menolak *refreshing DOM tree* saat melakukan submit formulir.
