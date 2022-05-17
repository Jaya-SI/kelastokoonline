<?php
session_start();
$id = $_GET['id'];

unset($_SESSION['keranjang'][$id]);

echo "<script>alert('data berhasil di hapus');
    document.location.href='keranjang.php';
    </script>";


?>