<?php
$koneksi = mysqli_connect("localhost", "root", "", "takemyherb");
    require 'config.php';
    
    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    }
    else {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id_user'] != 0){
                echo "<script>alert('Anda tidak memiliki izin akses pada halaman ini!')
                    window.location.replace('market.php')
                </script>";
            }
        }
    };
    
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
