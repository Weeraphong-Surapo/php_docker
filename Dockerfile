# ใช้ PHP พร้อม Apache
FROM php:8.2-apache

# Copy ไฟล์ทั้งหมดเข้า container
COPY . /var/www/html/

# เปิด port 80 ภายใน container (map ออก 8090 ที่ docker run)
EXPOSE 80
