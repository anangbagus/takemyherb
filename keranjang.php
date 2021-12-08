<?php 
    require("config.php");

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    };

    $username = $_SESSION['username'];
    $keranjang = query("SELECT k.*, u.username, p.* FROM keranjang k INNER JOIN user u ON k.id_user = u.id_user INNER JOIN produk p ON k.id_produk = p.id_produk WHERE u.username = '$username'")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
</head>
<body>
    <h1><ins>Keranjang</ins></h1>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; foreach($keranjang as $row) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
            <td><?=$row["harga"]; ?></td>
            <td><?=$row["deskripsi"]; ?></td>
            <td><?=$row["foto"]; ?></td>
            <td>
                <a href="detailproduk.php?id_produk=<?= $row['id_produk'];?>">Beli</a>
                <a href="hapuskeranjang.php?id_keranjang=<?= $row['id_keranjang'];?>" onclick="return confirm('Hapus item ke keranjang?')">Hapus</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</body>
</html>