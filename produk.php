<?php
    // menghubungkan dengan file config.php
    require('config.php');

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

    // pengambilan data dari tabel produk
    $produk = query("SELECT id_produk, nama_produk, manfaat, harga, deskripsi, stok, foto, tipe FROM produk");

    // jika menekan tombol cari
    if(isset($_POST["cari"])){
        $produk = cariproduk($_POST["keyword"]);
    }

    // jika menekan tombol carikategori
    if(isset($_POST["carikategori"])){
        $produk = caritipeproduk($_POST["kategori"]);
    }

    // inisialisasi nilai jumlah data
    $jumlah = query("SELECT COUNT(*) FROM produk")[0];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>produk</title>
</head>
<body style="background-color: rgb(238,238,238);">

    <div class="container-fluid py-5">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="row">

                    <?php include('_sidebar.php'); ?>


                    <div class="col-lg-9 col-md-8 ">
                        
                        <!-- Pencarian -->
                        <h1 class="text-center">Data produk</h1>
                        <div class="">
                            <a href="addproduk.php"><i class="bi bi-plus-circle-fill text-success d-inline" style="font-size: 40px;"></i></a> 
                            <h4 class="d-inline"> Tambah Produk </h4>
                            (Jumlah produk: <?php echo $jumlah["COUNT(*)"];?>)
                            <br>
                        </div>
                        <div class="">
                            <form class="d-inline" action="" method="post">
                                <input type="text" name="keyword" autofocus placeholder="Cari" autocomplete="off">
                                <button type="submit" name="cari">Cari</button>
                            </form>
                        </div>
                        
                        <!-- menampilkan jumlah produk -->
                        
                        <!-- menampilkan table -->
                        <!-- <table border="1" cellpadding="10" cellspacing="0">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Manfaat</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                                <th>Foto</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr> -->
                            
                            <?php foreach($produk as $row) : ?>
                            <div class="container mt-3 mb-3">
                                <div class="d-flex row">
                                    <div class="col-md-12">
                                        <div class="row p-2 bg-white border rounded">
                                            <div class="col-md-2 mt-1 mr-3 text-end">
                                                <img class="img-fluid img-responsive rounded product-image" style="height: 160px;" src="img/<?=$row["foto"]; ?>.jpg"></div>
                                            <div class="col-md-8 mt-1">
                                                <h5><?=$row["nama_produk"]; ?></h5>
                                                <p class="text-justify para mb-0"> <?=$row["deskripsi"]; ?> <br></p>
                                                Harga : Rp.<?=$row["harga"]; ?>,00 <br>
                                                Tipe : <?=$row["tipe"]; ?> <br>
                                                Stok : <?=$row["stok"]; ?>
                                            </div>
                                            <div class="align-items-center align-content-center col-md-2 border-left mt-1">
                                                <div class="d-flex flex-row align-items-center" style="font-size: 30px;">
                                                    <a href="editproduk.php?id_produk=<?=$row["id_produk"]; ?>"> <i class="bi bi-pencil-square text-success"></i> </a> 
                                                    <a href="deleteproduk.php?id_produk=<?=$row["id_produk"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill text-success"></i></a>
                                                </div>
                                                <div class="d-flex flex-column ">
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- <tr>
                                <td><?php echo "<a href='detailproduk.php?id_produk=".$row["id_produk"]."'>".$row["id_produk"]."</a>"; ?></td>
                                <td><?=$row["nama_produk"]; ?></td>
                                <td><?=$row["manfaat"]; ?></td>
                                <td><?=$row["harga"]; ?></td>
                                <td><?=$row["deskripsi"]; ?></td>
                                <td><?=$row["stok"]; ?></td>
                                <td><?=$row["foto"]; ?></td>
                                <td><?=$row["tipe"]; ?></td>
                                <td>
                                    <a href="editproduk.php?id_produk=<?=$row["id_produk"]; ?>"><i class="bi bi-pencil-square"></i></a> |
                                    <a href="deleteproduk.php?id_produk=<?=$row["id_produk"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr> -->
                            <?php endforeach; ?>
                        <!-- </table> -->
                        <br> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/sidebars.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>