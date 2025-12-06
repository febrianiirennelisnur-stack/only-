<?php
session_start();
require 'config.php';
require 'functions.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Proses simpan ujian
if (isset($_POST['create_exam'])) {
    $exam_name = $_POST['exam_name'];
    $exam_date = $_POST['exam_date'];
    $exam_duration = $_POST['exam_duration'];

    $stmt = $conn->prepare("INSERT INTO exams (exam_name, exam_date, duration) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $exam_name, $exam_date, $exam_duration);

    if ($stmt->execute()) {
