<?php 
// menghubungkan dengan file config.php
require 'config.php';

// validasi login
// pengguna harus melakukan login terlebih dahulu
// sebelum dapat mengakses halaman ini
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$id_keranjang = $_GET['id_keranjang'];
$qty = $_GET['qty'];
if(isset($_GET['checkout'])){
    $a = $_GET['checkout'];
}
if(isset($_GET['hapusitem'])){
    $a = $_GET['hapusitem'];
}

if($a == "Checkout"){
    // proses melakukan update data quantity sesuai id_keranjang
    $query = "UPDATE keranjang SET qty = '$qty' WHERE id_keranjang = '$id_keranjang'";
    mysqli_query($koneksi, $query);
    header("Location: checkout.php?id_keranjang=$id_keranjang&a=$a");
}
else if($a == "Hapus"){
    // proses melakukan hapus data sesuai id_keranjang
    $query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
    mysqli_query($koneksi, $query);
    
    if (mysqli_affected_rows($koneksi)) {
        echo "
        <script>
        alert( 'Item Telah Berhasil Dihapus' );
        document.location.href = 'keranjang.php'
        </script>
        ";
    } else {
        echo "
        <script>
        alert( 'Item Gagal Dihapus' );
        document.location.href = 'keranjang.php'
        </script>
        ";
    }
}


?>