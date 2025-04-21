<<<<<<< HEAD
# UTSMovie
=======
## About Laravel Movie DB

Ini adalah sistem database movie menggunakan laravel untuk mata kuliah Konstruksi dan Evolusi Perangkat Lunak Prodi Teknologi Rekayasa Perangkat Lunak Jurusan Teknologi Informasi Politeknik Negeri Padang.

Silahkan clone repository ini ke PC Anda.
Jika Anda baru saja meng-clone repository proyek Laravel dan ingin menjalankan perintah migrasi, ada beberapa langkah yang perlu Anda lakukan terlebih dahulu. Berikut adalah langkah-langkahnya:

1. **Composer Install:**
   Pastikan Anda telah menginstal Composer di sistem Anda. Kemudian, jalankan perintah berikut di terminal di direktori proyek Laravel Anda untuk menginstal dependensi:

    composer install

2. **Environment File:**
   Duplikat file `.env.example` menjadi `.env` di direktori proyek Anda. Sesuaikan pengaturan database dan konfigurasi lainnya di file `.env` sesuai dengan kebutuhan Anda.

    cp .env.example .env

3. **Generate Application Key:**
   Laravel menggunakan kunci aplikasi untuk enkripsi data. Jalankan perintah berikut untuk menghasilkan kunci aplikasi:

    php artisan key:generate

4. **Set Database Connection:**
   Pastikan bahwa pengaturan koneksi database di file `.env` sesuai dengan konfigurasi database Anda.

   Contoh: Jika Anda membuat database dbmovie, maka di file `.env` ubahlah `DB_DATABASE=laravel` menjadi `DB_DATABASE=dbmovie`

6. **Run Migrations:**
   Sekarang Anda dapat menjalankan perintah migrasi untuk membuat tabel-tabel database:

    php artisan migrate

    Perintah ini akan mengeksekusi semua migrasi yang terkandung di proyek Laravel ini.

7. **Run Seeds (Opsional):**
   Proyek ini menggunakan _seeding_ untuk mengisi basis data awal, jalankan perintah berikut:

    php artisan db:seed

    Perintah ini akan menjalankan seeder yang telah didefinisikan.

8. **Serve Aplikasi:**
   Setelah langkah-langkah di atas selesai, Anda dapat menjalankan server pengembangan Laravel untuk melihat proyek Anda:

    php artisan serve

    Aplikasi akan berjalan di http://localhost:8000 secara default.

_Credit by: Yori Adi Atma_
>>>>>>> 3ea8817 (first commit)
