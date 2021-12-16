<?php 
// menghubungkan dengan file config.php
require ('config.php');
 
error_reporting(0);

// validasi login
// jika pengguna sudah login maka akan diarahkan ke halaman market.php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: market.php");
}

// cek tombol apakah sudah ditekan atau belum
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // validasi data pengguna
    // jika password dan confirmation password tidak sama akan diberikan pemberitahuan
    if ($password == $cpassword) {
        // pengambilan data dari tabel user
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($koneksi, $sql);
        if (!$result->num_rows > 0) {
            // melakukan insert data pengguna ke dalam tabel user
            $sql = "INSERT INTO user (`id_user`, `nama_user`, `email`, `username`, `password`, `hp`)
                    VALUES ('', '$name', '$email', '$username', '$password', '$phone')";
            $result = mysqli_query($koneksi, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $name = "";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                $email = "";
                $phone = "";
                header("Location: index.php");
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan. Kalo ada salah brrti user_id belom auto increment')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
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
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css"
    rel="stylesheet"
    />
 
    <title>Register</title>
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                                    <form class="mx-1 mx-md-4" action="" method="POST" >   
                                        
                                        <!-- Nama  -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                            
                                            <input type="text" id="form3Example1c" class="form-control" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
                                            
                                            <label class="form-label" for="form3Example1c">Your Name</label>
                                            
                                            </div>
                                        </div>

                                        <!-- Username  -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                            
                                            <input type="text" id="form3Example1d" class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                                            
                                            <label class="form-label" for="form3Example1d">Username</label>
                                            
                                            </div>
                                        </div>

                                        

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4c" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4cd" class="form-control" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">

                                            <input type="email" id="form3Example3c" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                                            
                                            <label class="form-label" for="form3Example3c">Your Email</label>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">

                                            <input type="text" id="form3Example3dd" class="form-control"  placeholder="Phone" name="phone" value="<?php echo $phone; ?>" required>
                                            
                                            <label class="form-label" for="form3Example3dd">Your Phone</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <label class="form-check-label" for="form2Example3">
                                            Anda sudah punya akun? <a href="index.php">Login </a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button name="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                        </form>



                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.js"
    ></script>

</body>
</html>