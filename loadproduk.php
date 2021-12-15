
<!-- product list -->
<div class="container-fluid py-5">
        <div class="container">
           

            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="list-group">
                            <?php
                            require('config.php');
                            $produk_types = query("SELECT tipe, COUNT(*) AS jumlah FROM produk GROUP BY tipe;");
                            foreach($produk_types as $produk_type) : ?>
                            <a href="google.com" class="list-group-item d-flex justify-content-between align-items-center"><?=$produk_type["tipe"]; ?>
                                <span class="badge bg-primary rounded-pill"><?=$produk_type["jumlah"]; ?></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-9 col-md-8 ">
                        <div class="row">

<!-- <tr>
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

<?php 
$keyword = "";
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
};

$produk = query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR manfaat LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");

foreach($produk as $row) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                                <a href="detailproduk.php?id_produk=<?=$row["id_produk"]?>" class="test">
                                <div class="card">
                                <img src="img/<?=$row["foto"]; ?>.jpg" class="card-img-top" style="height: 200px; object-fit: cover;"  alt="<?=$row["nama_produk"]; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$row["nama_produk"]; ?>
                                        <span class="badge bg-success rectangle-pill"><?=$row["stok"]; ?></span>
                                    </h5> 
                                    <div class="text-truncate">
                                        <?=$row["deskripsi"]; ?>
                                    </div>
                                    <p class="font-monospace"> Rp.<?=$row["harga"]; ?>,00</p>
                                </div>
                                </div>
                                </a>
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
        <a href="addkeranjang.php?id_produk=<?= $row['id_produk'];?>" onclick="return confirm('Masukkan item ke keranjang?')">Tambah Keranjang</a>
    </td>
</tr> -->
<?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>