<?php
    require('config.php');
    $user = query("SELECT * FROM user");

    // jika menekan tombol cari
    if(isset($_POST["cari"])){
        $user = cariuser($_POST["keyword"]);
    }

    // inisialisasi nilai jumlah data
    $jumlah = query("SELECT COUNT(*) FROM user")[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User</title>
</head>
<body>

    <h1><ins>Data User</ins></h1>
    <br>

    <!-- Pencarian -->
    <b>Pencarian</b>
    <form action="" method="post">
        <input type="text" name="keyword" autofocus placeholder="Cari" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br> 

    <!-- menampilkan table -->
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
        
        <?php foreach($user as $row) : ?>
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

    <!-- menampilkan jumlah user -->
    <a>Jumlah user: <?php echo $jumlah["COUNT(*)"];?>

    <br><br><br><br><br>
    <br><br><br><br><br>
</body>
</html>