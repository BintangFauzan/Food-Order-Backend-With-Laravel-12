<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Food Order Backend (Laravel 12)

## Deskripsi
Ini adalah backend API untuk aplikasi pemesanan makanan (Food Order) yang dibangun menggunakan Laravel 12. Proyek ini menyediakan fitur manajemen user, kategori makanan, makanan, pesanan, dan autentikasi menggunakan Laravel Sanctum.

---

## Track Proses Pengerjaan

### 1. Inisialisasi Project
- Membuat project Laravel baru
- Menyiapkan struktur folder dan file dasar
- Konfigurasi database dan environment

### 2. Setup Autentikasi
- Instalasi dan konfigurasi Laravel Sanctum
- Membuat fitur register dan login user
- Menambahkan proteksi route dengan middleware `auth:sanctum`

### 3. CRUD User
- Membuat model, migration, controller, dan resource untuk User
- Implementasi endpoint CRUD user

### 4. CRUD Kategori Makanan
- Membuat model, migration, controller, dan resource untuk Category
- Implementasi endpoint CRUD kategori makanan

### 5. CRUD Makanan
- Membuat model, migration, controller, dan resource untuk Food
- Implementasi endpoint CRUD makanan

### 6. CRUD Pesanan & Item Pesanan
- Membuat model, migration, controller, dan resource untuk Order & OrderItem
- Implementasi endpoint CRUD pesanan dan item pesanan

### 7. Fitur Logout
- Menambahkan endpoint logout untuk menghapus token user

### 8. Testing Manual API
- Pengujian endpoint menggunakan Postman
- Dokumentasi cara testing login, register, CRUD, dan logout

### 9. Dokumentasi
- Menyusun README dan dokumentasi endpoint

---

## Cara Menjalankan Project
1. Clone repository ini
2. Jalankan `composer install`
3. Copy `.env.example` ke `.env` dan sesuaikan konfigurasi database
4. Jalankan `php artisan key:generate`
5. Jalankan migrasi: `php artisan migrate`
6. Jalankan server: `php artisan serve`

---

## Cara Testing API di Postman
1. **Register**: POST `/api/register` dengan body (name, email, password, role)
2. **Login**: POST `/api/login` dengan body (email, password)
   - Simpan token dari response
3. **Akses endpoint protected**: Tambahkan header `Authorization: Bearer {token}`
4. **Logout**: POST `/api/logout` dengan header token

---

## Kontributor
- Bintang Fauzan Dyan

---

## Lisensi
Lisensi bebas digunakan untuk pembelajaran.

---

<!--
Bagian di bawah ini adalah template Laravel default, dapat dihapus jika tidak diperlukan.
-->
