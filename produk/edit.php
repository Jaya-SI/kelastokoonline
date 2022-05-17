<?php
session_start();
$id_produk = $_GET['id'];
include '../produk/fungsi.php';

$produk = query("SELECT * FROM produk WHERE id_produk = '$id_produk'")[0];
$kategori = query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Tambah Produk</title>
    <style>
        .dropdown:hover>.dropdown-menu {
            display: block;
        }
    </style>
</head>

<body>
    <!-- membuat navbar -->
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
                                <li><a class="dropdown-item <?php echo $halaman == 'tambah produk' ? 'active' : '' ?>" href="tambah_produk.php">Tambah Produk</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Edit Produk' ? 'active' : '' ?>" href="edit_produk.php">Edit produk</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Tambah Admin' ? 'active' : '' ?>" href="#">tambah Admin</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Ubah Admin' ? 'active' : '' ?>" href="#">Ubah Admin</a></li>
                                <li><a class="dropdown-item <?php echo $halaman == 'Laporan Penjualan' ? 'active' : '' ?>" href="laporan_penjualan.php">Laporan Penjualan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link ml-4 <?php echo $halaman == 'home' ? 'active' : '' ?>" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-4 <?php echo $halaman == 'produk' ? 'active' : '' ?> ml-4" href="../index.php">Product</a>
                    </li>
                    <li class="nav-item ml-4">
                        <a class="nav-link <?php echo $halaman == '' ? 'active' : 'keranjang' ?>" href=" keranjang.php">keranjang</a>
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
    <div class="container" style="margin-top: 120px;">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Produk</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="gambar_terdahulu" value="<?= $produk['img']; ?>">
                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                <div class="mb-3">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?= $produk['nama'] ?>">
                </div>
                <div class="mb-3">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <?php foreach ($kategori as $row) : ?>
                            <option value="<?= $row['kategori']; ?>" <?php if ($row['kategori'] == $produk['kategori']) {
                                                                            echo "selected";
                                                                        } ?>><?= $row['kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" autocomplete="off" value="<?= $produk['harga']; ?>">
                </div>
                <div class="mb-3">
                    <label for="gambar">Gambar</label><br>
                    <img src="../produk/img/<?= $produk['img']; ?>" alt="" width="200px" class="border mr-2">
                    <input type="file" name="gambar" id="gambar">
                </div>
                <button class="btn btn-primary" name="ubah">Ubah</button>
            </form>
        </div>
    </div>
</body>

</html>

</html>
<?php
if (isset($_POST['ubah'])) {
    if (ubah_produk($_POST) > 0) {
        echo "<script>alert('data berhasil di ubah');location='../produk/edit_produk.php';</script>";
    } else {
        echo "<script>alert('Tidak ada data yang di ubah');</script>";
        echo mysqli_error($conn);
    }
}


?>