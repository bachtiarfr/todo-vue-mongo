# Aplikasi ToDoList dengan Laravel, Vue, dan MongoDB

Aplikasi ToDoList adalah proyek pengembangan web sederhana yang menggunakan Laravel, Vue.js, dan MongoDB untuk manajemen tugas-tugas Anda. Aplikasi ini memiliki fitur CRUD untuk tugas, pengingat melalui email, dan ringkasan statistik.

## Persyaratan

- PHP 7.4 atau lebih baru
- Composer
- Node.js dan npm
- MongoDB 4
- Laravel 9
- Vue 3

## Instalasi

1. **Clone repositori ini:**

    ```shell
    git clone https://github.com/bachtiarfr/todo-vue-mongo.git
    ```

2. **Instal dependensi PHP menggunakan Composer:**

    ```shell
    composer install
    ```

3. **Instal dependensi JavaScript menggunakan npm:**

    ```shell
    npm install
    ```

4. **Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database MongoDB Anda.**

5. **Migrate database dan mulai server:**

    ```shell
    php artisan migrate
    php artisan serve
    ```
6. **Jalankan kan halaman depan nya:**

    ```shell
    npm run hot
    ```
7. **Konfigurasi email untuk pengingat dalam file `.env`.**

8. **Jalankan tugas pengingat melalui Task Scheduler Laravel:**

    ```shell
    php artisan schedule:run
    ```
## Penggunaan

1. Akses aplikasi di `http://localhost:8000` (make sure sudah npm run hot).
2. Jangan lupa set database mongodb nya
3. Untuk test scheduler email nya, setup configurasi mail di .env case disini saya pake mailstrap.io
