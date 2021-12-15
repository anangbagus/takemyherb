<?php
include "config.php";
$id_pemesanan = $_GET['id_pemesanan'];
$mode = $_GET['mode'];

if(isset($_GET['mode'])){
    if($_GET['mode'] == "OnProc"){
        $query = "UPDATE pemesanan SET status = '2' WHERE id_pemesanan = $id_pemesanan";
        mysqli_query($koneksi, $query);

        if (mysqli_affected_rows($koneksi)) {
            echo "
            <script>
            document.location.href = 'detailpesanan.php'
            </script>
            ";
        } else {
            echo "
            <script>
            alert( 'Status Gagal Diubah' );
            document.location.href = 'detailpesanan.php'
            </script>
            ";
        }
    }
    elseif($_GET['mode'] == "Cancel"){
        $query = "UPDATE pemesanan SET status = '0' WHERE id_pemesanan = $id_pemesanan";
        mysqli_query($koneksi, $query);

        if (mysqli_affected_rows($koneksi)) {
            echo "
            <script>
            document.location.href = 'detailpesanan.php'
            </script>
            ";
        } else {
            echo "
            <script>
            alert( 'Status Gagal Diubah' );
            document.location.href = 'detailpesanan.php'
            </script>
            ";
        }
    }
}
?>