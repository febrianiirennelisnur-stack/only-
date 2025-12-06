<?php
session_start();
include "../config.php";
include "../functions.php";

// Cek apakah admin sudah login
cek_login_admin();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin CBT</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f7;
            margin: 0;
            padding: 0;
        }

        .header {
            background: #130f40;
            color: white;
            padding: 18px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .menu {
            display: flex;
            flex-direction: column;
