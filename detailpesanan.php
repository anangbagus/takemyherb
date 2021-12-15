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

    // pengambilan data pada tabel pemesanan
    $pesanan = query("SELECT * FROM pemesanan");

    // penghitungan jumlah data pada tabel pemesanan
    $jumlah = query("SELECT COUNT(*) FROM pemesanan")[0];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>produk</title>
</head>
<body>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <!-- sidebar -->
                        <h1 class="visually-hidden">Sidebars examples</h1>

                        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                            <span class="fs-4">Admin</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                            <a href="#" class="nav-link text-white" aria-current="page">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                            </li>
                            <li>
                            <a href="#" class="nav-link active">
                                <i class="bi bi-columns-gap"></i> Produk 
                            </a>                      
                            </li>
                            <li>
                            <a href="profile.php" class="nav-link text-white">
                                <i class="bi bi-file-person"></i> Akun
                            </a>
                            </li>
                            <li>
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-wallet2"></i> Metode Pembayaran
                            </a>
                            </li>
                            <li>
                            <a href="logout.php" class="nav-link text-white">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </a>
                            </li>
                            
                        </ul>
                        <hr>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>mdo</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                        </div>

                    <div class="b-example-divider"></div>
                    </div>


                    <div class="col-9 col-md-8 ">
                        <h1><ins>Detail Pesanan</ins></h1>
                        <br> <br>
                        <!-- menampilkan jumlah produk -->
                        <a>Jumlah Pesanan: <?php echo $jumlah["COUNT(*)"];?>
                        <!-- menampilkan table -->
                        <table border="1" cellpadding="10" cellspacing="0">
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            
                            <?php foreach($pesanan as $row) : ?>
                            <tr>
                                <td><?php echo $row["id_pemesanan"]; ?></td>
                                <td><?=$row["tgl_pemesanan"]; ?></td>
                                <td><?=$row["id_user"]; ?></td>
                                <td><?=$row["id_produk"]; ?></td>
                                <td><?=$row["quantity"]; ?></td>
                                <td><?=$row["total_harga"]; ?></td>
                                <td><?=$row["alamat_pengiriman"]; ?></td>
                                <td>
                                    <?php
                                    if($row["status"] == 0){
                                        echo "Canceled";
                                    }
                                    else if($row["status"] == 1){
                                        echo "Waiting";
                                    }
                                    else if($row["status"] == 2){
                                        echo "On Process";
                                    }
                                    else if($row["status"] == 3){
                                        echo "Success";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="modelpesanan.php?id_pemesanan=<?=$row["id_pemesanan"]; ?>&mode=OnProc"><i class="bi bi-pencil-square"></i></a> |
                                    <a href="modelpesanan.php?id_pemesanan=<?=$row["id_pemesanan"]; ?>&mode=Cancel" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
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