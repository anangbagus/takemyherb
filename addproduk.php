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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-color: rgb(238,238,238);
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2)
        }

        .blue-text {
            color: #00BCD4
        }

        .form-control-label {
            margin-bottom: 0
        }

        input,
        textarea,
        button, select {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer
        }

        .btn-block:hover {
            color: #fff !important
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }
    </style>
</head>

<body>
    <div class="container-fluid px-1  mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card">
                    <h4 class="text-center mb-4 d-inline text-success">Tambah produk</h4> 
                    <h6 class="d-inline"></h6>
                    
                    <form action="" class="form-card" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label px-3">Nama Produk</label> 
                                
                                <input type="text" name="nama_produk" id="nama_produk" required> 
                            
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label px-3">Harga</label> 

                                <input type="number" name="harga" id="harga" required>
                            
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Stok</label> 
                                <input type="number" name="stok" id="stok" required>
                             </div>
                            
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Tipe</label> 
                            
                            <select id="tipe" name="tipe">
                                <option value="Bibit">Bibit</option>
                                <option value="Benih">Benih</option>
                                <option value="Pupuk">Pupuk</option>
                                <option value="Alat">Alat</option>
                            </select>
                            </div>
                        
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <label class="form-control-label px-3">Manfaat</label> 
                                <input type="text" name="manfaat" id="manfaat" required>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex"> 
                                <label class="form-control-label px-3"> Deskripsi </label> 
                                
                                <input type="text" name="deskripsi" id="deskripsi" required>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-12 mt-3"> 
                                <button type="submit" name="submit" class="btn-block btn-success">Simpan</button> 
                                <button type="reset" name="submit" class="btn-block btn-outline-success">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>