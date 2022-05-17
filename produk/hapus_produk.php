<?php 
session_start();
include "fungsi.php";
$id = $_GET['id'];

if(hapus_produk($id)>0){
    echo "<script>
    alert('data berhasil di hapus');
    document.location.href='edit_produk.php';
    </script>";
    
}else{
    echo "<script>
    alert('data Gagal di hapus');
    document.location.href='edit_produk.php';
    </script>";
}




?>