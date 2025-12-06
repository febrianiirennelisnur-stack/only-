<?php
session_start();
require 'config.php';
require 'functions.php';

// Cek apakah siswa login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Pastikan exam_id dikirim
if (!isset($_GET['exam_id'])) {
    echo "Ujian tidak ditemukan.";
    exit();
}

$exam_id = $_GET['exam_id'];

// Ambil data ujian
$exam = $conn->prepare("SELECT * FROM exams WHERE id = ?");
$exam->bind_param("i", $exam_id);
$exam->execute();
$exam_result = $exam->get_result()->fetch_assoc();

// Ambil soal ujian
$questions = $conn->prepare("SELECT * FROM questions WHERE exam_id = ?");
$questions->bind_param("i", $exam_id);
$questions->execute();
