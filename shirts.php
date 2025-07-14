<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shirts Collection - Dwarkesh Menswear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation -->
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reviews.php">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="features.html">Size Chart</a>
                    </li>
                </ul>
                <div class="ms-3">
                    <a href="admin/login.php" class="btn btn-gold btn-sm">
                        <i class="fas fa-user-shield me-2"></i>Admin Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="hero-section" style="min-height: 60vh;">
        <div class="hero-overlay">
            <div class="container">
                <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
                    <div class="col-lg-8 text-center">
                        <h1 class="hero-title animate-text">
                            <span class="text-gold">Shirts</span> Collection
                        </h1>
                        <p class="hero-subtitle">Discover our premium collection of formal and casual shirts</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-5" style="background: var(--secondary-black);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <select class="form-select" id="priceFilter" style="max-width: 200px;">
                            <option value="all">All Prices</option>
                            <option value="low">Under ₹500</option>
                            <option value="medium">₹500 - ₹1000</option>
                            <option value="high">Over ₹1000</option>
                        </select>
                        <select class="form-select" id="sortFilter" style="max-width: 200px;">
                            <option value="name">Sort by Name</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="popular">Most Popular</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shirts Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4" id="shirtsContainer">
              <?php
              $result = mysqli_query($conn, "SELECT * FROM products WHERE category='shirt'");
              while ($row = mysqli_fetch_assoc($result)) {
                $priceTag = ($row['price'] <= 500) ? 'low' : (($row['price'] <= 1000) ? 'medium' : 'high');
                echo '<div class="col-lg-3 col-md-6" data-price="'.$priceTag.'">
                               <div class="product-card">
                   <img src="'.$row['image'].'" alt="'.$row['name'].'" class="product-image">
                   <div class="product-info">
                       <h5 class="product-title">'.$row['name'].'</h5>
                       <div class="product-price">₹'.$row['price'].'</div>
                       <div class="product-stock">'.($row['stock'] ? 'In Stock' : 'Out of Stock').'</div>
                       <div class="d-flex justify-content-between align-items-center">
                           <div class="like-counter">
                               <i class="fas fa-heart like-btn" data-likes="'.$row['likes'].'"></i>
                               <span class="like-count">'.$row['likes'].'</span> likes
                           </div>
                           <button class="btn btn-gold btn-sm buy-now-btn"
                               data-name="' . htmlspecialchars($row['name']) . '"
                               data-price="' . htmlspecialchars($row['price']) . '"
                               data-category="' . htmlspecialchars($row['category']) . '">
                               Buy Now
                                      </button>
                       </div>
                   </div>
               </div>
           </div>';

              }
              ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-gold">Dwarkesh Menswear</h5>
                    <p class="text-light">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Mendarda, Junagadh, Gujarat, India
                    </p>
                    <p class="text-light">
                        <i class="fas fa-phone me-2"></i>
                        +91 98765 43210
                    </p>
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
                <p class="text-light mb-0">&copy; 2024 Dwarkesh Menswear. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeButtons = document.querySelectorAll('.like-btn');
            likeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const likeCount = this.nextElementSibling;
                    let currentLikes = parseInt(likeCount.textContent);

                    if (this.classList.contains('liked')) {
                        currentLikes--;
                        this.classList.remove('liked');
                        this.style.color = '#ccc';
                    } else {
                        currentLikes++;
                        this.classList.add('liked');
                        this.style.color = '#ff6b6b';
                    }

                    likeCount.textContent = currentLikes;
                });
            });

            const priceFilter = document.getElementById('priceFilter');
            const sortFilter = document.getElementById('sortFilter');
            function filterProducts() {
                const price = priceFilter.value;
                const products = document.querySelectorAll('[data-price]');
                products.forEach(product => {
                    const productPrice = product.getAttribute('data-price');
                    product.style.display = (price === 'all' || productPrice === price) ? 'block' : 'none';
                });
            }
            priceFilter.addEventListener('change', filterProducts);
            sortFilter.addEventListener('change', filterProducts);
        });
    </script>
    <!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" action="place-order.php" method="POST">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Place Your Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body bg-black text-white">
        <input type="hidden" name="product_name" id="orderProductName">
        <input type="hidden" name="product_price" id="orderProductPrice">
        <input type="hidden" name="product_category" id="orderProductCategory">

        <div class="mb-3">
          <label class="form-label">Your Name</label>
          <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Your Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Delivery Address</label>
          <textarea name="address" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer bg-dark">
        <button type="submit" class="btn btn-gold">Confirm Order</button>
      </div>
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buyNowButtons = document.querySelectorAll('.buy-now-btn');
    const modal = new bootstrap.Modal(document.getElementById('orderModal'));

    buyNowButtons.forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('orderProductName').value = this.getAttribute('data-name');
            document.getElementById('orderProductPrice').value = this.getAttribute('data-price');
            document.getElementById('orderProductCategory').value = this.getAttribute('data-category');
            modal.show();
        });
    });
});
</script>

</body>
</html>
