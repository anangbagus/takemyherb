<?php
    // menghubungkan dengan file config.php
    require('config.php');

    //mengecek url, 
    //jika tidak ada id_user -> lempar ke index
    if(!isset($_GET["id_user"])){
        header("Location: index.php");
        exit();
    }
    else{
        //jika ada, jalankan query
        $id_user = $_GET["id_user"];
        $result = query("SELECT k.id_keranjang, k.tgl, k.id_produk, p.nama_produk FROM keranjang AS k 
                        INNER JOIN produk AS p ON p.id_produk=k.id_produk WHERE k.id_user='$id_user'");
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail user</title>
</head>
<body>

<h2>Detail user: <?php echo $id_user?></h2>
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
