<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($koneksi, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['id_user'] == 0){
            header("Location: produk.php");
        }
        else {
            header("Location: market.php");
        }
    }
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
 
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        if ($row['id_user'] == 0){
            header("Location: produk.php");
        }
        else {
            header("Location: market.php");
        }
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css" rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css">
 
    <title>Login</title>
</head>
<body>
    <div class="" role="alert">
        <?php echo $_SESSION['error']?>
    </div>


    <!-- MDBoostrap Login -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login TakeMyHerb</p>

                <form action="" method="POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <!-- Email input -->
                    <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" value="<?php echo $email; ?>" required>
                    <label class="form-label" for="form1Example13">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" value="<?php echo $_POST['password']; ?>" required>
                    <label class="form-label" for="form1Example23">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                <div class="d-flex justify-content-around align-items-center mt-4">
                    <!-- Checkbox -->
                    <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
                </div>

                

                </form>
            </div>
            </div>
        </div>
        </section>
    <!-- endOf MDBootstrap Login -->
     <!-- MDB -->
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.js"></script>

</body>
</html>