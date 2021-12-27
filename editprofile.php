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
        $filename = $_FILES["imgupload"]["name"];
        $tempname = $_FILES["imgupload"]["tmp_name"];    
        $folder = "img/profile/".$filename;
    
        mysqli_query($koneksi,"UPDATE user SET nama_user = '$nama', email = '$email', username = '$username', hp = '$phone', `image` = '$filename' WHERE id_user = '$id'");

        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

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
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <title>Edit Profile</title>
</head>
<body class="body">
<div class="container mt-5 d-flex justify-content-center">
        <div class="profile--card p-5">
            <h3 class="text-center text-success"> Edit Profile </h3>
            <table class="profile--table">
            <form action="" method="POST" enctype="multipart/form-data">
            <?php foreach($user as $row): ?>  
            <div class="d-flex flex-column justify-content-center align-items-center">
                <input type="file" id="imgupload" name="imgupload" style="display:none"/>
                <div class="imgUpload profile--img--container mt-3">
                    <img class="profile--img" src="img/profile/<?= $row['image']; ?>" />
                    <i class="profile--img__upload bi bi-arrow-bar-up"></i>   
                    <!-- <img class="" src="https://img.icons8.com/material-outlined/24/000000/upload--v1.png"/> -->
                </div>
                <h4>
                    <span><?= $row['nama_user'];?></span>
                </h4>
                <div class="profile--form d-flex flex-row justify-content-center align-items-center gap-2"> 
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama" id="nama" value="<?= $row['nama_user']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="email" id="email" value="<?= $row['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="username" id="username" value="<?= $row['username']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="phone" id="phone" value="<?= $row['hp']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="profile--button--container">
                        <div class="d-flex">
                            <input type="submit" value="Update" class="profile--button mt-3" name="update">
                            <div class="m-1"></div>
                            <input class="profile--button profile--button__cancel mt-3" action="action" onclick="window.history.go(-1); return false;" type="submit" value="Batal"/>
                        </div>
                    </td>
                </tr>
                </div>
            </div>
            <?php endforeach; ?>
            </form>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.imgUpload').click(function(){$('#imgupload').trigger('click')});
        });
    </script>
</body>
</html>