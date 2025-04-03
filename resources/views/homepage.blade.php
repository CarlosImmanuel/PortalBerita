<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .pointer { cursor: pointer; }
        .news-image { width: 100%; border-radius: 8px; }
        .category-badge { position: absolute; top: 10px; left: 10px; background: blue; color: white; padding: 5px 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center">
            <i class="bi bi-house pointer mr-3"></i>
            <input class="form-control" type="search" placeholder="Search">
        </div>
        <img src="logo.png" alt="Infonet" height="40">
        <div>
            <button class="btn btn-primary">Sign In</button>
            <a href="#" class="ml-2">Register</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="p-3 bg-light rounded">
                    <h5>Kategori</h5>
                    <ul class="list-unstyled">
                        <li>Berita Terbaru</li>
                        <li>Politik</li>
                        <li>Ekonomi</li>
                        <li>Teknologi</li>
                        <li>Hiburan</li>
                        <li>Olahraga</li>
                        <li>Bisnis</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <h4>Berita utama hari ini</h4>
                <div class="position-relative">
                    <img src="headline.jpg" class="news-image">
                    <h5 class="position-absolute text-white" style="bottom: 10px; left: 10px;">Gedung Putih Bocorkan Momen Trump Usir Zelensky</h5>
                </div>

                <h4 class="mt-4">Berita terbaru</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="position-relative">
                            <span class="category-badge">Ekonomi</span>
                            <img src="news1.jpg" class="news-image">
                        </div>
                        <p>Shell Sampai BP Kompak Naikkan Harga BBM Per Hari Ini 1 Maret 2025</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="position-relative">
                            <span class="category-badge">Ekonomi</span>
                            <img src="news2.jpg" class="news-image">
                        </div>
                        <p>Antrean SPBU Shell Mengular, Mendadak Ramai Usai Isu BBM Oplosan</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="position-relative">
                            <span class="category-badge">Ekonomi</span>
                            <img src="news3.jpg" class="news-image">
                        </div>
                        <p>Badan Gizi Sebut Pemda Tak Wajib Alokasikan Anggaran untuk MBG</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5 p-4 bg-light">
        <img src="logo.png" alt="Infonet" height="40">
        <div class="mt-2">
            <i class="bi bi-instagram mx-2"></i>
            <i class="bi bi-x mx-2"></i>
            <i class="bi bi-facebook mx-2"></i>
        </div>
        <p class="mt-3">Copyright 2025 IN. All rights reserved.</p>
    </footer>
</body>
</html>
