<?php
$koneksi = mysqli_connect("localhost", "root", "", "takemyherb");
    // session_start();
    // if( !isset($_SESSION["login"])){
    //     header("Location: login.php");
    // }
    
    require 'config.php';
    $id= $_GET["id_produk"];

    if( hapusproduk($id)>0 ) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href='produk.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href='produk.php';
            </script>
        ";
    }
