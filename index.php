<?php
include "produk/fungsi.php";
$halaman = 'home';
session_start();
$produk = query("SELECT * FROM produk");

?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }
</style>
</head>

<body>
    <!-- membuat navbar -->
    <?php
    if (isset($_GET['aktif'])) {
        $link = $_GET['aktif'];
    }

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Toko Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav" style="margin-left:700px;">
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <div class="dropdown-toggle mt-2" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </div>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item <?php echo $halaman == 'tambah produk' ? 'active' : '' ?>" href="produk/tambah_produk.php">Tambah Produk</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Edit Produk' ? 'active' : '' ?>" href="produk/edit_produk.php">Edit produk</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Tambah Admin' ? 'active' : '' ?>" href="#">tambah Admin</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Ubah Admin' ? 'active' : '' ?>" href="#">Ubah Admin</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Laporan Penjualan' ? 'active' : '' ?>" href="laporan_penjualan.php">Laporan Penjualan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link ml-4 <?php echo $halaman == 'home' ? 'active' : '' ?>" aria-current="page" href="<?= $halaman == 'home' ? 'index.php' : '../index.php' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-4 <?php echo $halaman == 'produk' ? 'active' : '' ?>" ml-4" href="<?= $halaman == 'home' ? 'index.php' : '../index.php' ?>">Product</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link <?php echo $halaman == '' ? 'active' : 'keranjang' ?>" " href=" keranjang.php">keranjang</a>
                    </li>
                    <?php if (isset($_SESSION['login'])) : ?>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="logout.php" onclick="return confirm('yakin ingin Logout ?')">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item ml-4">
                        <a class="nav-link active" href="checkout.php">checkout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->
    <?php
    include 'partials/produk.php';
    ?>
</body>

</html>