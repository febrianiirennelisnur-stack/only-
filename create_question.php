<?php
session_start();
require 'config.php';
require 'functions.php';

// Cek apakah admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Ambil daftar ujian untuk dropdown
$exams = $conn->query("SELECT * FROM exams");

// Proses simpan soal
if (isset($_POST['create_question'])) {
    $exam_id = $_POST['exam_id'];
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];

    $stmt = $conn->prepare(
        "INSERT INTO questions (exam_id, question_text, option_a, option_b, option_c, option_d, correct_answer)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("issssss", $exam_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer);

    if ($stmt->execute()) {
        $success = "Soal berhasil ditambahkan!";
    } else {
        $error = "Terjadi kesalahan saat menambah soal.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Soal - Admin CBT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }
        .container {
            width: 500px;
            background: white;
            margin: 20px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        textarea, input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        button {
            background: #2196F3;
            color: white;
            font-weight: bold;
        }
        .success {
            background: #c4f5c2;
            padding: 10px;
            border-radius: 5px;
            color: #1b7a23;
        }
        .error {
            background: #f8c5c5;
            padding: 10px;
            border-radius: 5px;
            color: #a11a1a;
        }
        a { text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Soal CBT</h2>

    <?php if (isset($success)) echo "<div class='success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form action="" method="POST">
        <label>Pilih Ujian:</label>
        <select name="exam_id" required>
            <option value="">-- Pilih Ujian --</option>
            <?php while ($exam = $exams->fetch_assoc()) : ?>
                <option value="<?= $exam['id']; ?>"><?= $exam['exam_name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Soal:</label>
        <textarea name="question_text" rows="4" required></textarea>

        <label>Pilihan A:</label>
        <input type="text" name="option_a" required>

        <label>Pilihan B:</label>
        <input type="text" name="option_b" required>

        <label>Pilihan C:</label>
        <input type="text" name="option_c" required>

        <label>Pilihan D:</label>
        <input type="text" name="option_d" required>

        <label>Jawaban Benar:</label>
        <select name="correct_answer" required>
            <option value="">-- Pilih Jawaban --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

        <button type="submit" name="create_question">Simpan Soal</button>
    </form>

    <br>
    <a href="admin_dashboard.php">⬅ Kembali ke Dashboard</a>
</div>

</body>
</html>
