<?php
    require('config.php');

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    };

    $produk = query("SELECT id_produk, nama_produk, manfaat, harga, deskripsi, stok, foto, tipe FROM produk");

    // jika menekan tombol cari
    if(isset($_POST["cari"])){
        $produk = cariproduk($_POST["keyword"]);
    }

    // jika menekan tombol carikategori
    if(isset($_POST["carikategori"])){
        $produk = caritipeproduk($_POST["kategori"]);
    }

    // inisialisasi nilai jumlah data
    $jumlah = query("SELECT COUNT(*) FROM produk")[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>produk</title>
</head>
<body>

    <h1><ins>Data produk</ins></h1>
    <br>

    <!-- Pencarian -->
    <b>Pencarian</b>
    <form action="" method="post">
        <input type="text" name="keyword" autofocus placeholder="Cari" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br> 

    <br>
    <a href="addproduk.php">Tambah Data Produk</a>
    <br> <br>

    <!-- menampilkan table -->
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Manfaat</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Tipe</th>
            <th>Aksi</th>
        </tr>
        
        <?php foreach($produk as $row) : ?>
        <tr>
            <td><?php echo "<a href='detailproduk.php?id_produk=".$row["id_produk"]."'>".$row["id_produk"]."</a>"; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
            <td><?=$row["manfaat"]; ?></td>
            <td><?=$row["harga"]; ?></td>
            <td><?=$row["deskripsi"]; ?></td>
            <td><?=$row["stok"]; ?></td>
            <td><?=$row["foto"]; ?></td>
            <td><?=$row["tipe"]; ?></td>
            <td>
                <a href="">Beli</a> |
                <a href="" onclick="return confirm('Masukkan item ke keranjang?')">Tambah Keranjang</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br> <br>

    <!-- menampilkan jumlah produk -->
    <a>Jumlah produk: <?php echo $jumlah["COUNT(*)"];?>

    <br><br><br><br><br>
    <br><br><br><br><br>
    <a href="keranjang.php">Keranjang</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="btn">Logout</a>
</body>
</html>