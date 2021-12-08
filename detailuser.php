<?php
    //memulai / melanjutkan session
    // session_start();
    require('config.php');

    // // mengecek session utk login
    // if( !isset($_SESSION["login"])){
    //     header("Location: login.php");
    // }

    //mengecek url, 
    //jika tidak ada id_user -> lempar ke index
    if( !isset($_GET["id_user"])){
        header("Location: index.php");
        exit();
    }
    //jika ada, jalankan query
        $id_user = $_GET["id_user"];
        $result = query("SELECT k.id_keranjang, k.tgl, k.id_produk, p.nama_produk FROM keranjang AS k 
                        INNER JOIN produk AS p ON p.id_produk=k.id_produk WHERE k.id_user='$id_user'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Detail user: <?php echo $var1["id_user"];?></title>
</head>
<body>

    <!-- Format Detail user -->
    <div class="detail">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID keranjang</th>
            <th>Tanggal</th>
            <th>ID Produk</th>
            <th>Nama Produk</th>
        </tr>
        
        <?php foreach($result as $row) : ?>
        <tr>
            <td><?=$row["id_keranjang"]; ?></td>
            <td><?=$row["tgl"]; ?></td>
            <td><?=$row["id_produk"]; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>