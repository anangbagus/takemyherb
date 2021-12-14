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
</tr>

<?php 
require('config.php');
$keyword = "";
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
};

$produk = query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR manfaat LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");

foreach($produk as $row) : ?>
<tr>
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
</tr>
<?php endforeach; ?>