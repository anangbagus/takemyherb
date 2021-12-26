<!-- php code -->
<?php 

require('config.php');
$produk_types = query("SELECT tipe, COUNT(*) AS jumlah FROM produk GROUP BY tipe;");
// inisialisasi nilai jumlah data
$jumlah = query("SELECT COUNT(*) AS total FROM produk;")[0];
?>

<!-- product list -->
    <div class="py-3 container col-12 mb-4">
        <div class="row">
            <div class="col-lg-3 col-md-4"> 
                <div class="list-group">
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                        Semua Produk
                        <span class="badge bg-success rounded-pill"><?= $jumlah['total']; ?></span>
                    </a>

                    <?php foreach($produk_types as $produk_type) : ?>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center"><?=$produk_type["tipe"]; ?>
                        <span class="badge bg-success rounded-pill"><?=$produk_type["jumlah"]; ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 ">
                <div class="row">

                <?php 
                $keyword = "";
                if(isset($_POST['keyword'])){
                    $keyword = $_POST['keyword'];
                };

                // pengambilan data produk sesuai dengan keyword
                $produk = query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR manfaat LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");

                foreach($produk as $row) : ?>
                <div class="market col-lg-3 col-md-4 col-sm-6 mb-5">
                    <!-- <a href="detailproduk.php?id_produk=<?=$row["id_produk"]?>" class=""> -->
                    <div class="card">
                        <img src="img/<?=$row["foto"]; ?>.jpg" class="card-img-top" style="height: 200px; object-fit: cover;"  alt="<?=$row["nama_produk"]; ?>">
                        <div class="card-body">
                            <span class="market--title card-title"><?=$row["nama_produk"]; ?> </span> 
                                <!-- <span class="badge bg-success rectangle-pill"><?=$row["stok"]; ?></span> -->
                                <span class="market--price"><b class="text-success"> Rp.<?=$row["harga"]; ?>,00 </b></span>
                            <div class="mb-2 mt-2 market--desc text-truncate">
                                <?=$row["deskripsi"]; ?>
                            </div>
                            
                            <a class="market--text" href="addkeranjang.php?id_produk=<?= $row['id_produk'];?>" onclick="return confirm('Masukkan item ke keranjang?')">
                                <button class="btn btn-success btn-sm mt-2" value="Checkout" name="checkout"> <i class="bi bi-cart-plus"></i>Tambah</button>
                            </a>
                            <a class="market--text" href="detailproduk.php?id_produk=<?=$row["id_produk"]?>" class="">
                                <button class="btn bg-light mt-2" > <i class="bi bi-eye"></i>Lihat</button>
                            </a>
                        </div>
                        </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
