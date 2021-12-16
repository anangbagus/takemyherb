<?php
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
        $session_username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username='$session_username'";
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            //mendapatkan id_user
            if ($row['id_user'] != 0){
                $id = $row['id_user'];
                $who = 2;
            }
            else{
                $id = $_GET['id_user'];
                $who = 1;
            }
        }
    };

    //mengakses record pada tabel user berdasarkan id
    $user = query("SELECT * FROM user WHERE id_user = $id");
    
    // jika user menekan tombol "Simpan"
    if(isset($_POST['update']))
    {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
    
        mysqli_query($koneksi,"UPDATE user SET nama_user = '$nama', email = '$email', username = '$username', hp = '$phone' WHERE id_user = '$id'");

        if($who == 1){
            $sql = "SELECT * FROM user WHERE username = '$session_username'";
        }
        else{
            $sql = "SELECT * FROM user WHERE id_user = '$id'";
        }
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id_user'] != 0){
                $_SESSION['username'] = $username;
                header("Location: profile.php");
            }
            else{
                header("Location: user.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Edit Profile</title>
</head>
<body>

    <h1><ins>Edit Profile</ins></h1>
    <br>

    <?php foreach($user as $row): ?>
    <table>
        <form action="" method="post">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama" id="nama" value="<?= $row['nama_user']; ?>">
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td>:</td>
                <td>
                    <input type="text" name="email" id="email" value="<?= $row['email']; ?>">
                </td>
            </tr>
            <tr>
                <td>username</td>
                <td>:</td>
                <td>
                    <input type="text" name="username" id="username" value="<?= $row['username']; ?>">
                </td>
            </tr>
            <tr>
                <td>phone</td>
                <td>:</td>
                <td>
                    <input type="text" name="phone" id="phone" value="<?= $row['hp']; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="Update" name="update">
                </td>
            </tr>
        </form>
    </table>
    <?php endforeach;?>
</body>
</html>