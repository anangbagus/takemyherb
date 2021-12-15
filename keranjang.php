<?php 
    // menghubungkan dengan file config.php
    require("config.php");

    // validasi login
    // pengguna harus melakukan login terlebih dahulu
    // sebelum dapat mengakses halaman ini
    session_start();
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    };

    $username = $_SESSION['username'];

    // pengambilan data dari beberapa tabel
    $keranjang = query("SELECT k.*, u.username, p.* FROM keranjang k INNER JOIN user u ON k.id_user = u.id_user INNER JOIN produk p ON k.id_produk = p.id_produk WHERE u.username = '$username'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; foreach($keranjang as $row) : ?>
        <tr>
            <form action="controlkeranjang.php" method="get">
                <td><?php echo $i; ?></td>
                <td><?=$row["nama_produk"]; ?></td>
                <td><?=$row["harga"]; ?></td>
                <td><?=$row["deskripsi"]; ?></td>
                <td><?=$row["foto"]; ?></td>
                <td>
                    <input type="text" name="qty" id="qty" value="<?= $row["qty"];?>">
                </td>
                <td>
                    <input type="hidden" name="id_keranjang" value="<?= $row['id_keranjang']?>">
                    <input type="submit" value="Checkout" name="checkout">
                    <input type="submit" value="Hapus" name="hapusitem">
                </td>
            </form>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</body>
</html>