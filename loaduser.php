<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>HP</th>
        <th>Aksi</th>
    </tr>

    <?php
    require ('config.php');
    $keyword = "";
    if(isset($_POST['keyword'])){
        $keyword = $_POST['keyword'];
    };

    $user = query("SELECT * FROM user WHERE nama_user LIKE '%$keyword%' OR email LIKE '%$keyword%' OR username LIKE '%$keyword%' OR hp LIKE '%$keyword%'");

    foreach($user as $row) : ?>
    <tr>
        <td><?php echo "<a href='detailuser.php?id_user=".$row["id_user"]."'>".$row["id_user"]."</a>"; ?></td>
        <td><?=$row["nama_user"]; ?></td>
        <td><?=$row["email"]; ?></td>
        <td><?=$row["username"]; ?></td>
        <td><?=$row["password"]; ?></td>
        <td><?=$row["hp"]; ?></td>
        <td>
            <a href="deleteuser.php?id_user=<?=$row["id_user"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br> <br>

<?php
// inisialisasi nilai jumlah data
$jumlah = query("SELECT COUNT(*) FROM user WHERE nama_user LIKE '%$keyword%' OR email LIKE '%$keyword%' OR username LIKE '%$keyword%' OR hp LIKE '%$keyword%'")[0];
?>

<!-- menampilkan jumlah user -->
<a>Jumlah user: <?php echo $jumlah["COUNT(*)"];?>