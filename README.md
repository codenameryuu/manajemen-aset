# Aplikasi Manajemen Aset

## Tentang

Aplikasi ini tentang manajemen aset yang terhubung dengan modul akutansi baik jurnal maupun buku besar

## Tools

Aplikasi ini dibangun menggunakan

1. Bahasa Pemrograman PHP versi 7.4 (tidak dapat menggunakan php 8)
2. Framework Codeigniter 3
3. Database MYSQL

## Account

1. username : `superadmin` dengan password `superadmin`, memiliki role sebagai superadmin
2. username : `pegawai` dengan password `pegawai`, memiliki role sebagai pegawai
3. username : `manajemen` dengan password `manajemen`, memiliki role sebagai manajemen

## Cara Instalasi

1. Untuk `base_url` defaultnya adalah `http://web_aset.test/`
2. Untuk `database` defaultnya adalah `db_aset`, anda dapat langsung import file sql yang tersedia
3. Ubah `base_url` pada file `application/config/config.php` sesuai dengan alamat url yang diinginkan
4. Untuk `database` dapat disesuaikan dengan merubah file `application/config/database.php`
5. Selamat mencoba... :)
