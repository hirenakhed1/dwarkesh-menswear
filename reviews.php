<?php
include 'db.php';

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? 'Anonymous');
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $rating = intval($_POST['rating']);

    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/reviews/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imagePath = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $query = "INSERT INTO reviews (name, title, comment, rating, image) VALUES ('$name', '$title', '$comment', $rating, '$imagePath')";
    mysqli_query($conn, $query);
    header("Location: reviews.php?success=1");
    exit();
}

$reviews = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Dwarkesh Menswear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.html">
            <i class="fas fa-tshirt me-2"></i>Dwarkesh Menswear
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link active" href="reviews.php">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="features.html">Size Chart</a></li>
            </ul>
            <div class="ms-3">
                <a href="admin/login.php" class="btn btn-gold btn-sm">
                    <i class="fas fa-user-shield me-2"></i>Admin Login
                </a>
            </div>
        </div>
    </div>
</nav>

<section class="hero-section" style="min-height: 50vh;">
    <div class="hero-overlay">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 50vh;">
                <div class="col-lg-8 text-center">
                    <h1 class="hero-title animate-text">Customer <span class="text-gold">Reviews</span></h1>
                    <p class="hero-subtitle">See what our customers say about our products</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Thank you for your review!</div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="review-form-card">
                    <h3 class="text-center mb-4 text-gold">Write a Review</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Your Name (Optional)">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title" placeholder="Review Title" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="5" placeholder="Your Review" required></textarea>
                        </div>
                        <div class="mb-3">
                            <select name="rating" class="form-select" required>
                                <option value="">Select Rating</option>
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-gold btn-lg">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: var(--secondary-black);">
    <div class="container">
        <h2 class="text-center mb-5 text-white">What Our Customers Say</h2>
        <div class="row g-4">
            <?php while ($r = mysqli_fetch_assoc($reviews)): ?>
            <div class="col-lg-4 col-md-6">
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <h5 class="text-gold"><?= htmlspecialchars($r['name']) ?></h5>
                            <div class="star-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="<?= $i <= $r['rating'] ? 'fas' : 'far' ?> fa-star star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <small class="text-gray"><?= date('F j, Y', strtotime($r['created_at'])) ?></small>
                    </div>
                    <h6 class="text-light"><?= htmlspecialchars($r['title']) ?></h6>
                    <p class="text-light"><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
                    <?php if (!empty($r['image'])): ?>
                        <img src="<?= htmlspecialchars($r['image']) ?>" alt="review image" class="img-fluid rounded mt-2">
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-gold">Dwarkesh Menswear</h5>
                <p class="text-light"><i class="fas fa-map-marker-alt me-2"></i> Mendarda, Junagadh, Gujarat, India</p>
                <p class="text-light"><i class="fas fa-phone me-2"></i> +91 90673 78687</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5 class="text-gold">Follow Us</h5>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-gold">
        <div class="text-center">
            <p class="text-light mb-0">&copy; 2025 Dwarkesh Menswear. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
