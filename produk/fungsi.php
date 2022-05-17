<?php
$conn = mysqli_connect('localhost', 'root', '', 'toko_online');
function query($query)
{
    global $conn;
    $rows = [];
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//funsi login pelanggan
function login($data){
    $username = $data['username'];
    $password = $data['password'];

    global $conn;
    $query = "SELECT * FROM login where username = '$username'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if(password_verify($password,$row['password'])){
            return mysqli_affected_rows($conn);
        }
    }return false;
    
}

//fungsi login admin
function login_admin($data){
    $username = $data['username'];
    $password = $data['password'];

    global $conn;
    $query = "SELECT * FROM admin where username = '$username'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_affected_rows($conn)>0){
        if(password_verify($password,$row['password'])){
            return 1;
        }
    }return false;
}

//fungsi tambah produk
function tambah_produk($data){
    global $conn;
    $nama = $data['nama'];
    $kategori = $data['kategori'];
    $harga = $data['harga'];
    $gambar = upload();
    if(!$gambar){
    return false;}
    mysqli_query($conn,"INSERT INTO produk VALUES('','$nama','$kategori','$harga','$gambar')");
    return mysqli_affected_rows($conn);
}

//fungsi upload
function upload(){
    $nama_file= $_FILES['gambar']['name'];
    $tipe_file=$_FILES['gambar']['type'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];

    //cek apakah ada gambar yang di upload
    if($error ===4){
        echo "<script>alert('tidak ada gambar yang di upload')</script>";
        return false;
    }
    //cek tipe file
    $ekstiensi_file_falid =['jpeg','jpg','png'];
    $ekstesiFile = explode(".",$nama_file);
    $ekstesiFile= strtolower(end($ekstesiFile));
    if(!in_array($ekstesiFile,$ekstiensi_file_falid)){
        echo "<script>alert('yang anda upload bukan gamber')</script>";
        return false;
    }

    //cek ukuran file
    if($size>1500000){
        echo "<script>alert('tidak Ukuran file terlau bersar')</script>";
        return false;
    }
    //jika lolos dari pengecerkan
    move_uploaded_file($tmp_name,"../produk/img/".$nama_file);
    return $nama_file;
}

//fungsi ubah produk
function ubah_produk($data){
    global $conn;
    $id = $data['id_produk'];
    $gambar_terdahulu = $data['gambar_terdahulu'];
    $nama = $data['nama'];
    $kategori = $data['kategori'];
    $harga = $data['harga'];
    if ($_FILES['gambar']['error']===4){
        $gambar = $gambar_terdahulu;
    }else{
        $gambar = upload();
    }
    mysqli_query($conn,"UPDATE produk SET nama ='$nama', kategori='$kategori', harga='$harga', img='$gambar' WHERE id_produk ='$id'");
    return mysqli_affected_rows($conn);
}

//fungsi registrasi
function register($data){
    global $conn;

    $username = $data['username'];
    $telepon = $data['telepon'];
    $email = $data['email'];
    $verifikasi = $data['ulang'];
    $password = $data['password'];
    
    //cek apakah passowod yang di input sudah sesuai
    if($password!==$verifikasi){
        echo "<script>alert('Verifikasi Passoword Salah..!')</script>";
        return false;
    }
    //cek apakah sudah ada username di table login
    $result = mysqli_query($conn,"SELECT username FROM login WHERE username = '$username'");
    if(mysqli_num_rows($result)>0){
        echo "<script>alert('Username sudah ada')</script>";
        return false;
    }

    //Enkripsi Password
    $password = password_hash($password,PASSWORD_DEFAULT);
    $query = "INSERT INTO login values('','$username','$telepon','$email','$password')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);

}

//fungsi registrasi admin
function register_admin($data){
    global $conn;

    $username = $data['username'];
    $telepon = $data['telepon'];
    $email = $data['email'];
    $verifikasi = $data['ulang'];
    $password = $data['password'];
    
    //cek apakah passowod yang di input sudah sesuai
    if($password!==$verifikasi){
        echo "<script>alert('Verifikasi Passoword Salah..!')</script>";
        return false;
    }
    //cek apakah sudah ada username di table login
    $result = mysqli_query($conn,"SELECT username FROM login WHERE username = '$username'");
    if(mysqli_num_rows($result)>0){
        echo "<script>alert('Username sudah ada')</script>";
        return false;
    }

    //Enkripsi Password
    $password = password_hash($password,PASSWORD_DEFAULT);
    $query = "INSERT INTO admin values('','$username','$password','$email','$telepon')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);

}

//funsi hapus produk
function hapus_produk($id){
    global $conn;
    $query = "DELETE from produk where id_produk = '$id'";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


//fungsi clar laporan penjualan
function clear(){
    global $conn;
    $query1 = "DELETE from pembelian ";
    $query2 = "DELETE FROM pembelian_produk";

    mysqli_query($conn,$query1);
    mysqli_query($conn,$query2);

    return mysqli_affected_rows($conn);
}
