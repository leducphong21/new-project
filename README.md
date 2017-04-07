# Garage Management

<!-- BADGES/ -->

[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)


## Hướng dẫn cài đặt

#### Chuẩn bị
Các phần mềm cần thiết
 - Composer
 - Git
 - Winscp
 - Putty
 - PhpStorm
 
 Các yêu cầu về server
 
 PHP phiên bản tối thiểu là PHP 5.5.0 (PHP 7 càng tốt vì Framework đã tích hợp PHP 7)
 Những thư viện cần thiết
 
 - intl
 - gd
 - mcrypt
 
 #### Cài đặt
 
 - Bước 1: Clone source code từ git
 - Bước 2: Cài đặt các thư viện
 
 Vào thư mục gốc của dự án và chạy lệnh
 composer install
 
 - Bước 3: Cấu hình ứng dụng
 
Copy file .env.dist sang .env và đặt trong thư mục gốc của dự án.
 
Tiếp đến Tùy chỉnh cấu hình trong file .env. Các tham số chính

    - THiết lập chế độ Debug 
 	```
 	YII_DEBUG   = true
 	YII_ENV     = dev
 	```
 	- Thiết lập DB
 	```
 	DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=garage
 	DB_USERNAME      = user
 	DB_PASSWORD      = password
 	```
 
 	- Thiết lập Url ứng dụng
 	```
 	FRONTEND_URL    = http://garage.dev
 	BACKEND_URL     = http://garage.dev/backend
 	STORAGE_URL     = http://garage.dev/storage
 	```
 
 - Bước 4: Thực hiện cài đặt ứng dụng
 
 Chạy dòng lệnh sau ở thư mục gốc của ứng dụng:
  
 ```
 php console/yii app/setup
 ```