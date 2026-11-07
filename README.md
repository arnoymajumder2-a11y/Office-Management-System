# Office Management System — OfficeFlow

A PHP + MySQL academic portfolio project for employee and office administration.

## Features
- Admin authentication
- Dashboard with employee, department, attendance and task summaries
- Employee directory (add and delete)
- Department management
- Daily attendance records
- Task tracking
- Salary and payment records
- Responsive interface and prepared SQL statements

## Requirements
- XAMPP (Apache + MySQL)
- PHP 8.0+ recommended
- MySQL / MariaDB

## Local installation
1. Copy `office-management-system` into `C:\xampp\htdocs\`.
2. Start Apache and MySQL in XAMPP.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. Check `config.php` database credentials (default XAMPP: root with blank password).
6. Open `http://localhost/office-management-system/setup.php` once.
7. Delete `setup.php` after setup.
8. Sign in at `http://localhost/office-management-system/login.php`.

Demo login:
- Email: `admin@officeflow.local`
- Password: `Admin@123`

## Portfolio note
Use sample/demo data only. Before public deployment, change database credentials, use HTTPS, set a strong admin password, disable public error output, and remove setup scripts. This is an academic demonstration project, not production payroll software.
