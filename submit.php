<?php
session_start();
require 'config.php';
require 'functions.php';

// Cek apakah user login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$exam_id = $_POST['exam_id'];

// Ambil semua soal dari ujian ini
$query = $conn->prepare("SELECT * FROM questions WHERE exam_id = ?");
$query->bind_param("i", $exam_id);
$query->execute();
$result = $query->get_result();

$score = 0;
$total = $result->num_rows;

// Hitung nilai
while ($row = $result->fetch_assoc()) {
    $question_id = $row[']()_
