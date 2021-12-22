<?php
require "config.php";

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$username = $_SESSION['username'];
$users = query("SELECT * FROM `user` WHERE username = '$username'");
foreach($users as $user):
    $id_user = $user['id_user'];
endforeach;
$id_produk = $_POST['id_produk'];
$text = $_POST['text'];

$query = "INSERT INTO `review` (`id_review`, `tgl_review`, `id_user`, `id_produk`, `ulasan`) VALUES (NULL, NOW(), '$id_user', '$id_produk', '$text')";
mysqli_query($koneksi, $query);
?>