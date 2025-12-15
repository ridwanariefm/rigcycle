# 🛒 RigCycle E-Commerce
### Sistem E-Commerce untuk Penjualan Komponen dan Part PC

[![Laravel v10/11](https://img.shields.io/badge/Laravel-v10/11-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss)](https://tailwindcss.com/)

## 📝 Deskripsi Proyek

RigCycle adalah platform e-commerce yang dikembangkan menggunakan framework Laravel, dirancang khusus untuk memfasilitasi penjualan komponen dan suku cadang PC (Baru dan Bekas).

Proyek ini mencakup fungsionalitas keranjang belanja, proses checkout yang terstruktur, integrasi pembayaran, dan riwayat pesanan yang *real-time*.

## ✨ Fitur Utama

* **Katalog Produk:** Filter dan pencarian berdasarkan Kategori, Nama Produk, dan Kondisi (Baru/Bekas).
* **Keranjang Belanja:** Manajemen kuantitas produk dan penghapusan item.
* **Checkout & Pengiriman:** Input detail alamat pengiriman terstruktur (Provinsi, Kota, Kode Pos).
* **Integrasi Pembayaran:** Pembayaran melalui layanan Midtrans (Snap Token Generation).
* **Riwayat Pesanan:** Dashboard pengguna menampilkan histori pesanan dengan status *real-time* (sinkron dengan Midtrans) dan detail produk yang dapat diklik.

## 🛠 Instalasi dan Pengembangan

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini secara lokal:

1.  **Clone Repository:**
    ```bash
    git clone [https://github.com/ridwanariefm/rigcycle.git](https://github.com/ridwanariefm/rigcycle.git)
    cd rigcycle
    ```

2.  **Instal Dependensi:**
    ```bash
    composer install
    npm install
    npm run dev # Atau npm run build
    ```

3.  **Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Atur koneksi database (`DB_*`) dan Midtrans (`MIDTRANS_*`) di file `.env`.

4.  **Migrasi Database:**
    Proyek ini memerlukan kolom-kolom baru (`shipping_address`, `subtotal`, dll.) yang telah ditambahkan.
    ```bash
    php artisan migrate
    ```

5.  **Jalankan Server:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan tersedia di `http://127.0.0.1:8000`.

## 🤝 Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan buat *Pull Request*.

---
