<?php
session_start();
include "config.php";

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek data di database
    $query = $conn->query("SELECT * FROM siswa WHERE username='$username' AND password='$password'");

    if ($query->num_rows > 0) {
