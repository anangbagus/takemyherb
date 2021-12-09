<?php 

require 'config.php';

// validasi akses
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
};

$alamat = $_POST['alamat'];
$id_keranjang = $_POST['id_keranjang'];
$total = $_POST['total'];

$keranjang = query("SELECT k.*, p.* FROM keranjang k INNER JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_keranjang = '$id_keranjang'");
foreach($keranjang as $row) :
    $id_user = $row['id_user'];
    $id_produk = $row['id_produk'];
    $qty = $row['qty'];
endforeach;

$query = "INSERT INTO pemesanan VALUES ('', NOW(), '$id_user', '$id_produk', '$qty', '$total', '$alamat')";
mysqli_query($koneksi, $query);

$query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'";
mysqli_query($koneksi, $query);

//cek apakah data berhasil ditambahkan atau tidak
if (mysqli_affected_rows($koneksi)) {
    //javascript untuk memberikan pemberitahuan
    //nanti index.php ganti jadi halaman anggota
    echo "
    <script>
    alert( 'Pesanan Berhasil Dibuat' );
    document.location.href = 'market.php'
    </script>
    ";
} else {
    echo "
    <script>
    alert( 'Pesanan Gagal Dibuat' );
    document.location.href = 'market.php'
    </script>
    ";
}

?>