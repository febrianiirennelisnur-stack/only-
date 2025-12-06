<?php
require_once 'config.php';
require_login();


// ambil list ujian
$res = $mysqli->query("SELECT * FROM exams");
$exams = [];
while ($r = $res->fetch_assoc()) $exams[] = $r;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Siswa</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
<h2>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
<a href="logout.php">Logout</a>
<h3>Daftar Ujian</h3>
<ul>
<?php foreach ($exams as $exam): ?>
<li>
<?php echo htmlspecialchars($exam['title']); ?>
<a href="exams/take.php?exam_id=<?php echo $exam['id']; ?>">Mulai</a>
</li>
<?php endforeach; ?>
</ul>
</div>
</body>
</html>