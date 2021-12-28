<?php 
    require('config.php');
    $query_;
    if(isset($_POST["action"]))
    {
        $query_ = "SELECT * FROM produk WHERE 1";
        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
        {
            $query_ .= "
            AND harga BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
            ";
        }
        if(isset($_POST["type"]))
        {
            $type_filter = implode("','", $_POST["type"]);
            $query_ .= "
            AND tipe IN('".$type_filter."')
            ";
        }
        if(isset($_POST["keyword"]))
        {
            $keyword = $_POST["keyword"];
            $query_ .= "
            AND nama_produk LIKE '%$keyword%'
            ";
        }

        if(isset($_POST["sort_by"]))
        {
            $sort_by_filter = implode(",", $_POST["sort_by"]);
            $query_ .="
            ORDER BY $sort_by_filter
            ";
        }
        

    }
    $produk = query($query_);
    //$keyword = "";
    // if(isset($_POST['keyword'])){
    //     $keyword = $_POST['keyword'];
    // };
    // pengambilan data produk sesuai dengan keyword
    // $produk = query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR manfaat LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");
?>
                  
            <?php foreach($produk as $row) : ?>
                <div class="market col-lg-3 col-md-4 col-sm-6 mb-5">
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
                                <button class="market--button" value="Checkout" name="checkout"> <i class="bi bi-cart-plus"></i>Tambah</button>
                            </a>
                            <a class="market--text" href="detailproduk.php?id_produk=<?=$row["id_produk"]?>" class="">
                                <button class="market--button market--button--view" > <i class="bi bi-eye"></i>Lihat</button>
                            </a>
                        </div>
                        </div>
                        </a>
                    </div>
                <?php endforeach; ?>





        