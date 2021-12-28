<?php
require_once "config.php";
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$username = $_SESSION['username'];
$users = query("SELECT * FROM `user` WHERE username = '$username'");
foreach($users as $user):
    $id_user = $user['id_user'];
endforeach;

if(isset($_GET['id_produk'])){
    $id_produk = $_GET['id_produk'];
    $produk = query("SELECT * FROM produk WHERE id_produk = $id_produk");
    foreach($produk as $row):
        $nama = $row['nama_produk'];
        $manfaat = $row['manfaat'];
        $harga = $row['harga'];
        $deskripsi = $row['deskripsi'];
        $stok = $row['stok'];
        $viewed = $row['viewed'] + 1;
        $tipe = $row['tipe'];
        $gambar = $row['foto'];
    endforeach;
    $query = "UPDATE produk SET viewed = $viewed WHERE id_produk = $id_produk";
    mysqli_query($koneksi, $query);
}
else{
    header("location: market.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_detailpesanan.css">
    <title>Detail Produk</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body class="body">
    <?php include('_header.php'); ?>
    <div class="detail--container">
        <div class="detail--items detail--left">
            <div>
                <img class="detail--items--image"src="img/<?=$gambar; ?>.jpg" style="height: 400px; object-fit: cover;"  alt="<?=$gambar; ?>">
                <center>
                    <i class="bi bi-eye"></i><?= $viewed; ?>
                </center> 
            </div>
            <div class="detail--items--product">
                <div class="input-comment">
                    <label>Berikan komentar anda:</label>
                    <br>
                    <input class="detail--search" type="text" name="review" id="review" placeholder="Comment...">
                    <button class="detail--button" id="kirim">Kirim</button>
                </div>
            </div>
            
            <!-- <img class="detail--img" src="img/1 kemangi.jpg"> </img> -->
        </div>
        <div class="detail--items detail--right">
            <div class="detail--items--product">
                <div class="detail--type">
                    <p>
                        <i class="bi bi-bag-dash-fill"></i> <?= $tipe; ?>
                    </p>
                </div>
                <div class="detail--title">
                    <h1>
                        <?= $nama; ?>
                    </h1>
                </div>
                <div class="detail--price">
                    <h3>
                        Rp.<?= $harga; ?>,00
                    </h3>
                </div>
                <div class="detail--star">
                    <h5>
                        Stock : <?= $stok; ?>
                    </h5>
                </div>
                <div class="detail--desc">
                    <p class="detail--desc--p">
                        <span>
                            <i class="bi bi-hash"></i> <?= $manfaat; ?>
                        </span>
                        <br>
                        <?= $deskripsi; ?>
                    </p>
                </div>
                <div class="detail--qty">
                    <!-- <p>
                    Masukkan jumlah: 
                    </p>
                    <input type="text"> -->
                </div>
                <div class="detail--addtocart mt-3">
                    <a href="addkeranjang.php?id_produk=<?= $id_produk?>" onclick="return confirm('Masukkan item ke keranjang?')">
                        <button class="detail--button" value="Checkout" name="checkout"> <i class="bi bi-cart-plus"></i> Masukkan ke Keranjang </button>
                    </a>
                </div>
            </div>
            <div>
                <div class="comment">
                    
                    <!-- Show Review List by AJAX -->
                    <div class="posted-comment"></div>
                </div>
            </div>
            

            
        </div>    
    </div>



    <!-- <div class="content">
        <table>
            <tr>
                <td><?= $nama; ?></td>
                <td><?= $manfaat; ?></td>
                <td><?= $harga; ?></td>
                <td><?= $deskripsi; ?></td>
                <td><?= $stok; ?></td>
                <td><?= $viewed; ?></td>
                <td>
                    <a href="addkeranjang.php?id_produk=<?= $id_produk?>" onclick="return confirm('Masukkan item ke keranjang?')">
                        <button class="btn btn-success btn-sm mt-2" value="Checkout" name="checkout"> Masukkan ke Keranjang </button>
                    </a>
                </td>
            </tr>
        </table>
    </div> -->

    <script>
        $(document).ready(function(){
            function load_review(id_produk)
            {
                $.ajax({
                    method:"POST",
                    url:"loadreview.php",
                    data: {id_produk: id_produk},
                    success:function(hasil)
                    {
                        $('.posted-comment').html(hasil);
                    }
                });
            }
            load_review(<?= $id_produk?>);
            $('#kirim').click(function(){
                $.ajax({
                    method: "GET",
                    url: "modelpesanan.php",
                    data: {mode: "cekpemesanan", id_user: <?= $id_user; ?>},
                    success: function(response){
                        var text = $("#review").val();
                        $.ajax({
                            method:"POST",
                            url:"modelreview.php",
                            data: {text: text, id_produk: <?= $id_produk?>},
                            success:function(response)
                            {
                                alert("Komentar ditambahkan.");
                                load_review(<?= $id_produk?>);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    },
                    error: function(response){
                        alert("Anda belum melakukan pemesanan atau status pesanan anda belum dikonfirmasi.");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>