![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/89a6e897-e62e-4a1d-8ede-58b84c2e4429)# Aplikasi ToDoList dengan Laravel, Vue, dan MongoDB

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

## Contoh Applikasi
Tampilan awal aplikasi
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/8e5a7f45-2248-406e-a759-c3e89fb8c0c7)
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/59404dff-5664-47d7-bdc5-011ed15395bc)
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/4284e7e4-40f2-4731-b0e1-e57faf65e2bf)

Masukan email untuk mengirimkan reminder, dengan memencet tulisan reminder di header
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/197ffdca-5a63-4f97-97a8-77af4db714a7)

Berikut contoh reminder nya
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/848a01c7-b48c-4006-8ab4-2b2bceb7d0f0)

Berikut contoh tampilan endpoint BE nya
![image](https://github.com/bachtiarfr/todo-vue-mongo/assets/50721686/d0a47f94-0665-45ce-bfe0-7f5ca2400b92)
