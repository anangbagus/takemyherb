<?php
require "config.php";
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

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
    $reviews = query("SELECT r.*, u.* FROM review r INNER JOIN user u ON u.id_user = r.id_user WHERE id_produk = $id_produk");
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
        <div class="posted-comment">
            <label>Komentar:</label>
            <br>
            <table>
                <?php foreach($reviews as $review): ?>
                    <tr>
                        <td><?= $review['nama_user']; ?></td>
                        <td><?= $review['ulasan']; ?></td>
                        <td><?= $review['tgl_review']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#kirim').click(function(){
                var text = $("#review").val();
                $.ajax({
                    method:"POST",
                    url:"modelreview.php",
                    data: {text: text, id_produk: <?= $id_produk?>},
                    success:function(response)
                    {
                        alert("Komentar ditambahkan.");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });
        });
    </script>
</body>
</html>