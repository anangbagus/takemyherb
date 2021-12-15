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
    else{
        $username = $_SESSION['username'];
    };

    // pengambilan data user sesuai dengan username
    $user = query("SELECT * FROM user where username = '$username'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
</head>
<body>

    <!-- navbar -->
    <?php include('_header.php'); ?>

    <!-- bootstrap -->
    <section class="team-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Profile </h2>
                <p class="text-center"> Edit your profile here </p>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                    <img class="rounded-circle" src="img/profile/1.jpg">
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <h3 class="name">Ben Johnson</h3>
                    <p class="title">Artist</p>
                    <table>
                    <?php foreach($user as $row):?>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?= $row['nama_user'];?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?= $row['username'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $row['email'];?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?= $row['hp'];?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <button>Edit Profile</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </table>
                    <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>