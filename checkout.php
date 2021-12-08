<?php 
    require("config.php");

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    };

    $username = $_SESSION['username'];
    $keranjang = query("SELECT k.*, u.username, p.* FROM keranjang k INNER JOIN user u ON k.id_user = u.id_user INNER JOIN produk p ON k.id_produk = p.id_produk WHERE u.username = '$username'");
    $jumlah = 1;
    $total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
</head>
<body>
    <h1><ins>Check Out</ins></h1>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        <?php $i = 1; foreach($keranjang as $row) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
            <td><?=$row["harga"]; ?></td>
            <td><?=$jumlah ?></td>
            <td><?= ($row["harga"] * $jumlah); ?></td>
        </tr>
        <?php $total+=($row["harga"] * $jumlah); $i++; endforeach; ?>
        <tr>
            <th colspan="4">Total</th>
            <td><?= $total;?></td>
        </tr>
    </table>
    <a href="">Check Out Semua</a>
</body>
</html>