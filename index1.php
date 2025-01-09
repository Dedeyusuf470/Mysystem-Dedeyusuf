<?php
// Konfigurasi Database
$host = "localhost"; // Nama host
$user = "root"; // Username database
$password = ""; // Password database
$database = "CVAku"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel
$userQuery = "SELECT id, nama, deskripsi, foto FROM users LIMIT 1";
$userResult = $conn->query($userQuery);
$userData = $userResult->fetch_assoc();

$educationQuery = "SELECT * FROM education";
$educationResult = $conn->query($educationQuery);

$projectQuery = "SELECT * FROM project";
$projectResult = $conn->query($projectQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">2203010063 Dede Muhamad Yusuf Ti-C</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education">EDUCATION</a></li>
                    <li class="nav-item"><a class="nav-link" href="#project">PROJECT</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Hero Text -->
                <div class="col-md-6 hero-content">
                    <h1><span>I’m</span> <br> <?= htmlspecialchars($userData['nama']) ?></h1>
                    <!-- Tampilkan Deskripsi -->
                    <p class="my-3"><?= htmlspecialchars($userData['deskripsi']) ?></p>
                    <a href="#" class="btn btn-dark">Download CV</a>
                </div>
                <!-- Hero Image -->
                <div class="col-md-6 text-center hero-image">
                    <img src="assets/images/<?= htmlspecialchars($userData['foto']) ?>" alt="Foto" class="img-fluid" width="100">
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="text-center">Education</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pendidikan</th>
                        <th>Tahun</th>
                        <th>Nama Sekolah / Kampus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($edu = $educationResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($edu['pendidikan']); ?></td>
                        <td><?= htmlspecialchars($edu['tahun']); ?></td>
                        <td><?= htmlspecialchars($edu['nama_sekolah']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Project Section -->
    <section id="project">
    <div class="container">
        <h2 class="text-center mb-4">Project</h2>
        <div class="row">
            <?php while ($project = $projectResult->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Gambar Project -->
                        <img src="<?= htmlspecialchars($project['image']); ?>" 
                             alt="<?= htmlspecialchars($project['project']); ?>" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        
                        <!-- Konten Card -->
                        <div class="card-body text-center">
                            <!-- Nama Project -->
                            <h5 class="card-title"><?= htmlspecialchars($project['project']); ?></h5>
                            
                            <!-- Deskripsi Project -->
                            <p class="card-text"><?= htmlspecialchars($project['keterangan']); ?></p>
                        </div>
                        
                        <!-- Footer Card -->
                        <div class="card-footer text-center">
                            <a href="<?= htmlspecialchars($project['link_project']); ?>" 
                               target="_blank" 
                               class="btn btn-primary">View Project</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>


    <!-- Contact Section -->
    <section id="contact" style="background-color: #f8f9fa; text-align: left;">
        <div class="container">
        <h2>Contact</h2>
        <p>Tasikmalaya</p>
        <p>Email: 2203010063@unper.ac.id</p>
        <p>Phone: +6282237187079</p>
        </div>
    </section>


    <!-- Footer -->
    <footer class="text-center py-3" style="background-color: #000; color: #fff;">
        <p>&copy; 2025 Website Dede Muhamad Yusuf. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
