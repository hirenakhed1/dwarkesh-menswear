<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

if (isset($_POST['reply'])) {
  $id = $_POST['id'];
  $reply = $_POST['reply_text'];
  mysqli_query($conn, "UPDATE reviews SET reply='$reply' WHERE id=$id");
}

$result = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");

// Star rating stats
$stats = mysqli_query($conn, "SELECT rating, COUNT(*) as total FROM reviews GROUP BY rating");
$rating_counts = [];
while ($row = mysqli_fetch_assoc($stats)) {
  $rating_counts[$row['rating']] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container my-5">
  <h2>User Reviews</h2>

  <h5 class="mt-4">⭐ Rating Summary</h5>
  <ul>
    <?php foreach ($rating_counts as $stars => $count): ?>
      <li><?= $stars ?> Stars: <?= $count ?> review(s)</li>
    <?php endforeach; ?>
  </ul>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="card bg-secondary my-3 p-3">
      <h5><?= $row['name'] ?> - ⭐ <?= $row['rating'] ?>/5</h5>
      <p><?= $row['comment'] ?></p>
      <?php if (!empty($row['image'])): ?>
        <img src="<?= $row['image'] ?>" width="100">
      <?php endif; ?>
      <form method="POST" class="mt-2">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <textarea name="reply_text" class="form-control" placeholder="Reply as admin"><?= $row['reply'] ?></textarea>
        <button class="btn btn-warning mt-2">Reply</button>
      </form>
    </div>
  <?php } ?>

  <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Back</a>
</div>
</body>
</html>
