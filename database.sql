-- Membuat database
CREATE DATABASE IF NOT EXISTS cbt;
USE cbt;

-- Tabel admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

INSERT INTO admin (username, password) VALUES
('admin', 'admin123');

-- Tabel siswa
CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    kelas VARCHAR(20) NOT NULL
);

INSERT INTO siswa (nama, username, password, kelas) VALUES
('Budi Hartono', 'budi', '12345', 'X IPA'),
('Siti Lestari', 'siti', '12345', 'X IPS');

-- Tabel soal
CREATE TABLE soal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pertanyaan TEXT NOT NULL,
    opsi_a VARCHAR(200) NOT NULL,
    opsi_b VARCHAR(200) NOT NULL,
    opsi_c VARCHAR(200) NOT NULL,
    opsi_d VARCHAR(200) NOT NULL,
    kunci VARCHAR(1) NOT NULL
);

INSERT INTO soal (pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, kunci) VALUES
('Ibu kota Indonesia adalah?', 'Bandung', 'Jakarta', 'Surabaya', 'Medan', 'B'),
('2 + 2 = ?', '3', '4', '5', '6', 'B'),
('Bahasa resmi negara Jepang?', 'Mandarin', 'Korea', 'Jepang', 'Thailand', 'C');

-- Tabel hasil ujian
CREATE TABLE hasil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT NOT NULL,
    nilai INT NOT NULL,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id) ON DELETE CASCADE
);
