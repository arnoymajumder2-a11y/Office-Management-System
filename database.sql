
CREATE DATABASE IF NOT EXISTS office_management_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE office_management_db;

-- Admin table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(160) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Departments table
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description VARCHAR(255)
);

-- Employees table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) UNIQUE NOT NULL,
    phone VARCHAR(30),
    position VARCHAR(100),
    department_id INT NULL,
    hire_date DATE NULL,
    FOREIGN KEY (department_id)
        REFERENCES departments(id)
        ON DELETE SET NULL
);

-- Attendance table
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    attendance_date DATE NOT NULL,
    status ENUM('Present', 'Absent', 'Leave') NOT NULL,
    UNIQUE KEY employee_day (employee_id, attendance_date),
    FOREIGN KEY (employee_id)
        REFERENCES employees(id)
        ON DELETE CASCADE
);

-- Tasks table
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    assigned_to VARCHAR(120),
    due_date DATE NULL,
    status ENUM('Pending', 'In Progress', 'Completed')
        DEFAULT 'Pending'
);

-- Salaries table
CREATE TABLE salaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    month CHAR(7) NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    paid_on DATE NULL,
    status ENUM('Paid', 'Pending') DEFAULT 'Pending',
    FOREIGN KEY (employee_id)
        REFERENCES employees(id)
        ON DELETE CASCADE
);
