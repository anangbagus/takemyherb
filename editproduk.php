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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
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
        button {
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
                    <h4 class="text-center mb-4 d-inline text-success">Edit Data Produk </h4> 
                    <img style="height: 200px; width: 200px; margin: auto; object-fit:cover;" src="img/<?php echo $data['foto'];?>.jpg"></img>
                    <h6 class="d-inline"> (id produk : <?php echo $data['id_produk'];?>) </h6>
                    <form action="" class="form-card" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label px-3">Nama Produk</label> 
                                <input type="text" id="fname" name="nama_produk"  value="<?php echo $data['nama_produk'];?>">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> 
                                <label class="form-control-label px-3">Harga</label> 
                                <input type="number" id="lname" name="harga" value="<?php echo $data['harga'];?>"> 
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Stok</label> 
                            <input type="number" id="email" name="stok" value="<?php echo $data['stok'];?>"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Tipe</label> 
                            <input type="text" id="mob" name="tipe" value="<?php echo $data['tipe'];?>"> </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-12 flex-column d-flex"> 
                                <label class="form-control-label px-3">Manfaat</label> 
                            <input type="text" id="job" name="manfaat" value="<?php echo $data['manfaat'];?>"> </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex"> 
                                <label class="form-control-label px-3"> Deskripsi </label> 
                                <input type="text" id="ans" name="deskripsi" value="<?php echo $data['deskripsi'];?>">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-12 mt-3"> 
                                <button type="submit" name="submit" class="btn-block btn-success">Simpan</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>