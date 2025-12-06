<?php
// config.php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = ''; // isi jika Laragon Anda pakai password
$DB_NAME = 'cbt_db';


$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($mysqli->connect_error) {
die('Connection error: ' . $mysqli->connect_error);
}
$mysqli->select_db($DB_NAME) or die('Database selection error');


session_start();


function is_logged_in() {
return isset($_SESSION['user_id']);
}


function require_login() {
if (!is_logged_in()) {
header('Location: /cbt/index.php');
exit;
}
}