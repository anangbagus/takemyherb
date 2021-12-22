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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Keranjang</title>
</head>
<body class="body">
    <?php include('_header.php'); ?>

    <!-- <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr> -->


    <div class="container cart--card mt-3 pt-3 pb-2 ">
        <div class="body--title">
            <h2>Keranjang</h2>
        </div>
    <?php $i = 1; foreach($keranjang as $row) : ?>
    <form action="controlkeranjang.php" method="get">
    <div>
        <div class="col-md-12 row m-3">
            <div class="col-md-2 cart--product--container">
                <img class="cart--product--image" src="img/<?=$row["foto"]; ?>.jpg">
            </div>
            
            <div class="cart--product--desc col-md-3">
                <div class="">
                    <h6 class="cart--product--title"><?=$row["nama_produk"]; ?></h6>
                    <div>
                        <span class="cart--product--desc__grey"> Tipe : </span>
                        <span class="cart--product--desc__bold"><?=$row["tipe"]; ?></span> 
                    </div>
                    <div>
                        <span class="cart--product--desc__grey"> Manfaat : </span>
                        <span class="cart--product--desc__bold"><?=$row["manfaat"]; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 cart--product--price">
                <p class="cart--product--price__right">
                    Rp.<?=$row["harga"]; ?>,00
                </p>
            </div>

            <div class="col-md-2 cart--product--qty">
                    Jumlah: 
                    <input type="text" name="qty" id="qty" value="<?= $row["qty"];?>">
                    <input type="hidden" name="id_keranjang" value="<?= $row['id_keranjang']?>">            
            </div>

            <div class="col-md-3 cart--product--button">
                <div >
                    <input type="submit" class="cart--button" value="Checkout" name="checkout">
                    <input type="submit" class="cart--button cart--button__cancel" value="Hapus" name="hapusitem">    
                </div>  
            </div>
        </div>
    </div>
    </form>
    <?php $i++; endforeach; ?>
    </div>

    
    <!-- <tr>
        <form action="controlkeranjang.php" method="get">
            <td><?php echo $i; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
            <td><?=$row["harga"]; ?></td>
            <td><?=$row["deskripsi"]; ?></td>
            <td><?=$row["foto"]; ?></td>
            <td>
                <input type="text" name="qty" id="qty" value="<?= $row["stok"];?>">
            </td>
            <td>
                <input type="hidden" name="id_keranjang" value="<?= $row['id_keranjang']?>">
                <input type="submit" value="Checkout" name="checkout">
                <input type="submit" value="Hapus" name="hapusitem">
            </td>
        </form>
    </tr> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>