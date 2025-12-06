<?php
// Menggunakan koneksi dari config.php
include "config.php";

/* ------------------------------------------------
   Fungsi Cek Login Siswa
------------------------------------------------- */
function cek_login_siswa() {
    if (!isset($_SESSION['siswa'])) {
        header("Location: ../login.php");
        exit;
    }
}

/* ------------------------------------------------
   Fungsi Cek Login Admin
------------------------------------------------- */
function cek_login_admin() {
    if (!isset($_SESSION['admin'])) {
        header("Location: admin_login.php");
        exit;
    }
}

/* ------------------------------------------------
   Fungsi Ambil Data Siswa Berdasarkan Username
------------------------------------------------- */
function get_siswa($username) {
    global $conn;
    $query = $conn->query("SELECT * FROM siswa WHERE username='$username'");
    return $query->fetch_assoc();
}

/* ------------------------------------------------
   Fungsi Ambil Semua Soal
------------------------------------------------- */
function get_soal() {
    global $conn;
    $query = $conn->query("SELECT * FROM soal ORDER BY id ASC");
    $data = [];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

/* ------------------------------------------------
   Fungsi Menilai Jawaban
------------------------------------------------- */
function hitung_skor($jawaban_user) {
    global $conn;
    $nilai = 0;

    foreach ($jawaban_user as $id_soal => $jawaban) {
        $query = $conn->query("SELECT * FROM soal WHERE id='$id_soal'");
        $data = $query->fetch_assoc();

        if ($jawaban == $data['kunci']) {
            $nilai++;
        }
    }

    return $nilai;
}

/* ------------------------------------------------
   Fungsi Anti SQL Injection Sederhana
------------------------------------------------- */
function aman($text) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($text));
}

/* ------------------------------------------------
   Fungsi Upload Gambar untuk Soal
------------------------------------------------- */
function upload_gambar($file) {
    $namaFile = $file['name'];
    $tmp = $file['tmp_name'];

    $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
    $namaBaru = time() . "_" . rand(100, 999) . "." . $ext;

    move_uploaded_file($tmp, "../upload/" . $namaBaru);

    return $namaBaru;
}
?>
