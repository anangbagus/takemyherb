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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Detail Produk</title>
</head>
<body>
    <div class="content">
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
    </div>
    <div class="comment">
        <div class="input-comment">
            <label>Berikan komentar anda:</label>
            <br>
            <input type="text" name="review" id="review" placeholder="Comment...">
            <br>
            <button id="kirim">Kirim</button>
        </div>
        <!-- Show Review List by AJAX -->
        <div class="posted-comment"></div>
    </div>
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
</body>
</html>