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
    $pesanan = query("SELECT ps.*, u.nama_user, p.nama_produk FROM pemesanan ps INNER JOIN user u ON ps.id_user = u.id_user INNER JOIN produk p ON ps.id_produk = p.id_produk");

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
<body  style="background-color: rgb(238,238,238);">
    <div class="container-fluid py-5">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="row">
                    
                    <?php include('_sidebar.php'); ?>

                    

                    <div class="col-lg-9 col-md-8 ">
                        <h1 class="text-center">Detail Pesanan</h1>
                        
                        <!-- menampilkan jumlah produk -->
                        <a>Jumlah Pesanan: <?php echo $jumlah["COUNT(*)"];?>
                        
                        <div class="table-responsive bg-white border rounded"  style="background-color: #ffffff;">
                            <table class="table table-responsive table-borderless p-2">
                                <thead>
                                    <tr class="bg-light">
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">Date</th>
                                        <th scope="col" width="15%">Nama Pemesan</th>
                                        <th scope="col" width="15%">Nama Produk</th>
                                        <th scope="col" width="5%">Jumlah</th>
                                        <th scope="col" width="15%">Total Harga</th>
                                        <th scope="col" width="15%">Alamat</th>
                                        <th scope="col" width="5%">Status</th>
                                        <th scope="col" class="text-end" width="10%"><span>Aksi</span></th>
                                    </tr>
                                </thead>
                                <?php foreach($pesanan as $row) : ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row["id_pemesanan"]; ?></td>
                                        <td><?=$row["tgl_pemesanan"]; ?></td>
                                        <td><?=$row["nama_user"]; ?></td>
                                        <td><?=$row["nama_produk"]; ?></td>
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
                                        <td class="text-end">
                                            <a href="modelpesanan.php?id_pemesanan=<?=$row["id_pemesanan"]; ?>&mode=OnProc"><i class=" bi bi-check2-circle text-success"></i></a> |
                                            <a href="modelpesanan.php?id_pemesanan=<?=$row["id_pemesanan"]; ?>&mode=Cancel" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill text-success"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <br> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/sidebars.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>