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
    <!-- hard refresh css -->
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Your Profile</title>
</head>
<body class="body">

    <!-- navbar -->
    <?php include('_header.php'); ?>

    <div class="profile--container container mt-5 d-flex justify-content-center">
        <div class="profile--card p-5">
            <h3 class="text-center text-success">Profile</h3>
            <table class="profile--table">
            <?php foreach($user as $row):?>    
            <div class="d-flex flex-column justify-content-center align-items-center">            
                <img class="profile--img mt-3" src="img/profile/<?= $row['image']; ?>"/> 
                <h4 class="mt-3">
                    <span><?= $row['username'];?></span>
                </h4>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?= $row['nama_user'];?></td>
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
                </div> 
            </div>
            <div class=" d-flex mt-2 text-center"> 
            </div>
            <?php endforeach; ?>
            </table>
            <a href="editprofile.php" class="profile--button mt-3">Edit Profile</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>