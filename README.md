<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Pendahuluan

Dalam konteks pengembangan aplikasi web dan API manajemen karyawan, sebuah proyek telah dilakukan untuk membangun sistem yang menyeluruh dan efisien. Pada laporan ini, penulis akan membahas hasil tes FSWD1 sesuai dengan studi kasus yang diberikan. Proyek ini berfokus pada pengelolaan data karyawan dan cuti yang dimana menggunakan Sanctum package untuk otentikasi dan penerapan Eloquent API Resource untuk mengelola data API dengan lebih efektif.

## Spesifikasi dan Library

1. Laravel 8.83
2. Axios
3. Datatable Yajra
4. Sweetalert
5. Blade Master Template : Argon Dashboard

## Dokumentasi API

https://documenter.getpostman.com/view/12312975/2s9YsGitfJ

## Hasil Test Case Beserta Penjelasan

https://drive.google.com/file/d/15DCJMiHO7FAttD81-EH935HCyXrLwhbs/view?usp=sharing

## Instalasi and Run project

git clone https://github.com/gitapin82y/FSWD1_APIN.git
copy .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
