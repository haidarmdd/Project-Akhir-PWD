CREATE DATABASE IF NOT EXISTS deadline_tracker;

USE deadline_tracker;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(10) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE deadlines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    judul VARCHAR(150) NOT NULL,
    mata_kuliah VARCHAR(100) NOT NULL,
    jenis ENUM('Tugas', 'Ujian', 'Praktikum') NOT NULL,
    tanggal_deadline DATE NOT NULL,
    status ENUM('belum', 'sedang', 'selesai') DEFAULT 'belum',
    file_tugas VARCHAR(255) DEFAULT NULL,
    semester INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);