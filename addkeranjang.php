<?php 

require 'config.php';

// validasi akses
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$id_produk = $_GET['id_produk'];
$username = $_SESSION['username'];

$users = query("SELECT * FROM user WHERE username = '$username'");
foreach ($users as $user):  
    $id_user = $user['id_user'];
endforeach;

$query = "INSERT INTO keranjang VALUES ('', NOW(), '$id_user', '$id_produk')";
mysqli_query($koneksi, $query);

//cek apakah data berhasil ditambahkan atau tidak
if (mysqli_affected_rows($koneksi)) {
    //javascript untuk memberikan pemberitahuan
    //nanti index.php ganti jadi halaman anggota
    echo "
    <script>
    alert( 'Item Telah Berhasil Ditambahkan' );
    document.location.href = 'market.php'
    </script>
    ";
} else {
    echo "
    <script>
    alert( 'Item Gagal Ditambahkan' );
    document.location.href = 'market.php'
    </script>
    ";
}

?>