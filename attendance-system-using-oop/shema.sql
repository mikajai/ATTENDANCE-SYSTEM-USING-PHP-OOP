CREATE TABLE attendance_system_users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    role ENUM('admin','student') NOT NULL, 
    student_number VARCHAR(50) NOT NULL UNIQUE,
    course_id INT,
    year_level ENUM('1', '2', '3', '4') NOT NULL, 
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course_program (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code  VARCHAR(50) NOT NULL UNIQUE, 
    course_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    year_level VARCHAR(50) NOT NULL,
    attendance_date DATE NOT NULL,
    attendance_time TIME NOT NULL,
    status VARCHAR(20) NOT NULL,
    is_late TINYINT(1) DEFAULT 0
);