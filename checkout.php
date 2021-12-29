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
    $id_keranjang = $_GET['id_keranjang'];
    $a = $_GET['a'];

    // cek tombol apakah sudah ditekan atau belum
    if(isset($_GET['id_keranjang'])){
        // proses pengambilan data dari beberapa tabel
        if($a == 'Checkout'){
            $keranjang = query("SELECT k.*, p.* FROM keranjang k INNER JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_keranjang = '$id_keranjang'");
        }
    }
    $total = 0;
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
    <style type="text/css">
        .input-style {
            padding: 3px;
            width: 80%;
            border: 1px solid #aaaaaa;
            border-radius: 8px;
            -webkit-appearance: none
        }
  </style>
  <title>Check Out</title>
</head>
<body class="body">
    <?php include('_header.php'); ?>
    <h1 class="checkout--title text-center mt-3">Check Out</h1>

    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
        <!-- <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr> -->
        <?php $i = 1; foreach($keranjang as $row) : ?>

        <div class="checkout--body container mt-3 mb-3">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-2 mt-1 mr-3 text-end">
                            <img class="checkout--image" style="height: 160px;" src="img/<?=$row["foto"]; ?>.jpg"></div>
                        <div class="col-md-6 mt-1">
                            <h5><?=$row["nama_produk"]; ?></h5>
                            <p class="checkout--desc"> <?=$row["deskripsi"]; ?></p>
                        </div>
                        <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <span class="strike-text"></span>
                            </div>
                            <div class="">
                                <table>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td><?= $row["qty"];?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp.<?=$row["harga"]; ?>,00</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>Rp.<?= ($row["harga"] * $row["qty"]); ?>,00</td>
                                    </tr>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <tr>
            <td><?php echo $i; ?></td>
            <td><?=$row["nama_produk"]; ?></td>
            <td><?=$row["harga"]; ?></td>
            <td><?=$row["qty"] ?></td>
            <td><?= ($row["harga"] * $row["qty"]); ?></td>
        </tr> -->
        <?php $total+=($row["harga"] * $row["qty"]); $i++; endforeach; ?>
       
    <form action="buatpesanan.php" method="post">
    
       
        <div class="container mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-8 mt-1 row">
                            <div class="row">
                                <div class="col-md-2 align-self-center">
                                    <label>Alamat : </label>
                                </div>
                                <div class="col-md-10">
                                    <input class="checkout--search" type="text" name="alamat" id="alamat">
                                    <input type="hidden" name="id_keranjang" value="<?= $id_keranjang;?>">
                                    <input type="hidden" name="total" value="<?= $total;?>">
                                </div>
                            </div>
                        </div>
                        <div class="align-self-center col-md-3">
                            <div class="d-flex flex-column ">
                                <h5> Total : Rp.<?= $total;?>,00 </h5>
                            </div>  
                        </div>
                        <input type="submit" class=" checkout--button" value="Kirim" name="kirim"/>
                    </div>
                </div>
            </div>
        </div>
    </form>    
    <!-- </table> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>