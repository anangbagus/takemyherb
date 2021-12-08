<?php
    require('config.php');

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    }
    else{
        $username = $_SESSION['username'];
    };

    $user = query("SELECT * FROM user where username = '$username'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1><ins>Profile</ins></h1>
    <br>

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
</body>
</html>