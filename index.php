<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $appName; ?></title>
    <!-- Menerapkan Font Eksternal jika diperlukan oleh tema tertentu -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="theme-<?php echo $themeMode; ?> layout-<?php echo $layoutMode; ?>">
    <div class="layout-wrapper">
        <header class="app-header">
            <h1 class="main-title"><?php echo $appName; ?></h1>
            <p class="main-desc"><?php echo $appDesc; ?></p>
        </header>

        <div class="main-content">
            <!-- Papan Kiri / Atas (Sesuai Layout) -->
            <section class="form-section card">
                <h2 id="form-title" class="section-title"><?php echo $labelForm; ?></h2>
                <form id="menu-form">
                    <input type="hidden" id="menu-id">
                    
                    <div class="input-group">
                        <label for="name">Nama Menu</label>
                        <input type="text" id="name" placeholder="Cth: Caffe Latte" required>
                    </div>

                    <div class="input-group">
                        <label for="category">Kategori</label>
                        <select id="category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Coffee">Coffee</option>
                            <option value="Non-Coffee">Non-Coffee</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="price">Harga (Rp)</label>
                        <input type="number" id="price" placeholder="Cth: 25000" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary" id="btn-save">Simpan Data</button>
                        <button type="button" class="btn-secondary hidden" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </section>

            <!-- Papan Kanan / Bawah (Sesuai Layout) -->
            <section class="table-section card">
                <h2 class="section-title">Daftar Menu Tersedia</h2>
                <div class="table-container">
                    <table id="menu-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="menu-tbody">
                            <tr>
                                <td colspan="5" class="loading-state">Memuat data dari PHP Server...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- Menghubungkan logika pemanggilan api.php -->
    <script src="main.js"></script>
</body>
</html>
