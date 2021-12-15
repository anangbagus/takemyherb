<?php 

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

// mempersiapkan data yang akan digunakan
$id_produk = $_GET['id_produk'];
$username = $_SESSION['username'];

// ambil data user dari database yang sesuai dengan
// pengguna yang sedang login
$users = query("SELECT * FROM user WHERE username = '$username'");
foreach ($users as $user):  
    $id_user = $user['id_user'];
endforeach;

// melakukan insert data produk yang ditambahkan ke keranjang
// ke dalam tabel keranjang
$query = "INSERT INTO keranjang VALUES ('', NOW(), '$id_user', '$id_produk', '1')";
mysqli_query($koneksi, $query);

//cek apakah data berhasil ditambahkan atau tidak
if (mysqli_affected_rows($koneksi)) {
    // javascript untuk memberikan pemberitahuan
    // kemudian akan diarahkan ke halaman market.php
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