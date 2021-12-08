<?php
$koneksi = mysqli_connect("localhost", "root", "", "takemyherb");

    //menghubungkan dengan function.php
    require 'config.php';

    // validasi akses
    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    }
    else {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id_user'] != 0){
                echo "<script>alert('Anda tidak memiliki izin akses pada halaman ini!')
                    window.location.replace('market.php')
                </script>";
            }
        }
    };

    //mendapatkan id_produk
    $id = $_GET['id_produk'];

    //mengakses record pada tabel produk berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
    $data = mysqli_fetch_assoc($result);

    //jika user menekan tombol "Simpan"
    if(isset($_POST['submit']))
    {
        $nama_produk    = $_POST['nama_produk'];
        $manfaat          = $_POST['manfaat'];
        $harga = $_POST['harga'];
        $deskripsi       = $_POST['deskripsi'];
        $stok   = $_POST['stok'];
        $tipe           = $_POST['tipe'];
    
        mysqli_query($koneksi,"UPDATE produk SET nama_produk='$nama_produk', manfaat='$manfaat', harga='$harga', deskripsi='$deskripsi', stok='$stok', tipe='$tipe' WHERE id_produk='$id'");

        // mysqli_query($koneksi,"CALL editproduk($id, $$nama_produk, '$manfaat', $harga, '$deskripsi', $stok, $tipe)");
        header("Location: produk.php");
        
        exit();//echo ("<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=http://localhost/takemyherb/produk.php\">");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit produk</title>
</head>

<body>

    <h1><ins>Edit Data produk</ins></h1><br>

    <!-- Membuat form-->
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="200">Id produk</td>
                <td> : </td>
                <td><?php echo $data['id_produk'];?></td>
            </tr>
            <tr>
                <td width="200">Nama Produk</td>
                <td> : </td>
                <td> <input type="text" name="nama_produk" style="width: 300px;" value="<?php echo $data['nama_produk'];?>"></td>
            </tr>
            <tr>
                <td width="200">Manfaat</td>
                <td> : </td>
                <td> <input type="text" name="manfaat" style="width: 300px;" value="<?php echo $data['manfaat'];?>"></td>
            </tr>
            <tr>
                <td width="200">Harga</td>
                <td> : </td>
                <td> <input type="number" name="harga" style="width: 300px;" value="<?php echo $data['harga'];?>"></td>
            </tr>
            <tr>
                <td width="200">Deskripsi</td>
                <td> : </td>
                <td> <input type="text" name="deskripsi" style="width: 300px;" value="<?php echo $data['deskripsi'];?>"></td>
            </tr>
            <tr>
                <td width="200">Stok</td>
                <td> : </td>
                <td> <input type="number" name="stok" style="width: 300px;" value="<?php echo $data['stok'];?>"></td>
            </tr>
            <tr>
                <td width="200">Tipe</td>
                <td> : </td>
                <td> <input type="text" name="tipe" style="width: 300px;" value="<?php echo $data['tipe'];?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td> <button type="submit" name="submit">Simpan</button> </td>
            </tr>
        </table>
    <form>
</body>
</html>