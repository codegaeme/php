# 📦 Dự án PHP

Dự án này được phát triển bằng ngôn ngữ PHP. Vui lòng đọc kỹ hướng dẫn cài đặt dưới đây để thiết lập môi trường và chạy ứng dụng thành công.

## 🧰 Yêu cầu hệ thống

- PHP >= 7.4 (khuyến khích PHP 8+)
- MySQL hoặc MariaDB
- Apache hoặc Nginx
- Composer (nếu dùng Laravel hoặc framework khác)
- Node.js + npm (nếu có xử lý asset bằng frontend tools)

---

## 🔧 Hướng dẫn cài đặt

### 👉 Đối với **dự án PHP thuần**

1. **Clone hoặc tải mã nguồn:**

```bash
git clone https://github.com/codegaeme/php
cd php
```
2. **Cấu hình database:**
```bash
Vào app\Commoms\Database.php
            $host = 'localhost';
            $db_name = 'ten_database';
            $user = 'root';
            $password = '';
            $port = '3306';
Vào env

Đổi http://localhost/duanmot/ thành http://localhost/php/
```
3. **Tạo database:**
```bash
Tạo database mới vào phpMyadmin nhập csdl trong dự án
```
4. **Chạy dự án:**
```bash
Vào trình duyệt gõ localhost/php
```
