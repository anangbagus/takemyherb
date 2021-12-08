<?php 

require 'config.php';

// validasi akses
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$id_keranjang = $_GET['id_keranjang'];

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

?>