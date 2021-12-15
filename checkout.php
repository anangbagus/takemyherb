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
    <link rel="stylesheet" href="css/style.css">
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
<body style="background-color: rgb(238,238,238);">
    <?php include('_header.php'); ?>
    <h1 class="text-center mt-3">Check Out</h1>
    <br>

    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
        <!-- <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr> -->
        <?php $i = 1; foreach($keranjang as $row) : ?>

        <div class="container mt-3 mb-3">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-2 mt-1 mr-3 text-end">
                            <img class="img-fluid img-responsive rounded product-image" style="height: 160px;" src="img/<?=$row["foto"]; ?>.jpg"></div>
                        <div class="col-md-6 mt-1">
                            <h5><?=$row["nama_produk"]; ?></h5>
                            <p class="text-justify para mb-0"> <?=$row["deskripsi"]; ?></p>
                        </div>
                        <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <span class="strike-text"></span>
                            </div>
                            <div class="d-flex flex-column ">
                                Jumlah : <?= $row["qty"];?> </br>
                                Harga  : <?=$row["harga"]; ?>
                                <p> Total Harga: <h5 class="mr-1">Rp.<?= ($row["harga"] * $row["qty"]); ?>,00</h5> </p>
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
                        <div class="col-md-8 mt-1">
                            <label>Alamat</label>
                            <input class="input-style" type="text" name="alamat" id="alamat">
                            <input type="hidden" name="id_keranjang" value="<?= $id_keranjang;?>">
                            <input type="hidden" name="total" value="<?= $total;?>">
                            <br>
                            <input type="submit" class="btn btn-primary btn-sm mt-2 d-inline" value="Kirim" name="kirim">
                        </div>
                        <div class="align-items-center align-content-center col-md-4 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                            </div>
                            <div class="d-flex flex-column ">
                                <h5> Total : Rp.<?= $total;?>,00 </h5>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


        
    <!-- </table> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>