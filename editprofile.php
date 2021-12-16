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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Profile</title>
</head>
<body style="background-color: rgb(238,238,238);">
<div class="container mt-4 mb-4 m-5 p-3 d-flex justify-content-center">
        <div class="card p-5">
            <h3 class="text-center text-success">Edit Profile</h3>
            <table>
            <form action="" method="post">
            <?php foreach($user as $row): ?>  
            <div class="image d-flex flex-column justify-content-center align-items-center"> 
                <button class="btn btn-secondary"> 
                
                <img src="img/profile/2.jpg" height="100" width="100" />
                </button> <h4><span class="name mt-3"><?= $row['nama_user'];?></span></h4>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
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
                        <input type="submit" value="Update" class="btn btn-success" name="update">
                    </td>
                </tr>
                </div> 
            </div>
            <div class=" d-flex mt-2 text-center"> 
            </div>
            <?php endforeach; ?>
            </form>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>