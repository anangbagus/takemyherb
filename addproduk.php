<?php
// menghubungkan dengan file config.php
require 'config.php';

// validasi login
// pengguna harus melakukan login terlebih dahulu
// sebelum dapat mengakses halaman ini
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('Anda belum melakukan login!')
        window.location.replace('index.php')
    </script>";
}
else {
    // validasi akses
    // pengguna harus merupakan admin yang ditandai
    // dengan id_user bernilai 0
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

// cek tombol apakah sudah ditekan atau belum
if (isset($_POST["submit"])) {
    $tipe = $_POST["tipe"];
    $nama_produk = $_POST["nama_produk"];
    $manfaat = $_POST["manfaat"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];
    $stok = $_POST["stok"];

    // melakukan insert ke tabel produk
    $query = "INSERT INTO produk (nama_produk, manfaat, harga, deskripsi, stok, tipe)
                VALUES ('$nama_produk', '$manfaat', '$harga', '$deskripsi', '$stok', '$tipe')";
    mysqli_query($koneksi, $query);

    // cek apakah data berhasil ditambahkan atau tidak
    if (mysqli_affected_rows($koneksi)) {
        // javascript untuk memberikan pemberitahuan
        // kemudian akan diarahkan ke halaman produk atau addproduk
        echo "
        <script>
        alert( 'Data Telah Berhasil Disimpan' );
        document.location.href = 'produk.php'
        </script>
        ";
    } else {
        echo "
        <script>
        alert( 'Data Gagal Disimpan' );
        document.location.href = 'addproduk.php'
        </script>
        ";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Tambah produk</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <div class="wrap">
        <span class="judul">
            <h1><ins>Tambah produk</ins></h1><br>
        </span>
        <form action="" method="post">
            <table>
                <tr>
                    <td> <label for="tipe">Tipe</label> </td>
                    <td>:</td>
                    <td>
                        <select id="tipe" name="tipe">
                            <option value="Bibit">Bibit</option>
                            <option value="Benih">Benih</option>
                            <option value="Pupuk">Pupuk</option>
                            <option value="Alat">Alat</option>
                        </select>
                    </td></tr>
                <tr>
                    <td> <label for="nama_produk">Nama Produk</label> </td>
                    <td>:</td>
                    <td> <input type="text" name="nama_produk" id="nama_produk" required> </ </tr>

                    <tr>
                    <td> <label for="manfaat">Manfaat</label> </td>
                    <td>:</td>
                    <td> <input type="text" name="manfaat" id="manfaat" required> </ </tr>

                <tr>
                    <td> <label for="harga">Harga</label> </td>
                    <td>:</td>
                    <td> <input type="number" name="harga" id="harga" required> </td>
                </tr>
                <tr>
                    <td> <label for="deskripsi">Deskripsi</label> </td>
                    <td>:</td>
                    <td> <input type="text" name="deskripsi" id="deskripsi" required> </ </tr>
                <tr>
                    <td> <label for="stok"> Stok </label> </td>
                    <td>:</td>
                    <td> <input type="number" name="stok" id="stok" required> </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <br>
                        <button type="reset" name="submit">Reset</button>
                        <button type="submit" name="submit">Simpan</button>
                    </td>
                </tr>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>