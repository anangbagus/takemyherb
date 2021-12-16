<?php 
    require('config.php');
    $low_price_products = query("SELECT * FROM produk ORDER BY harga ASC LIMIT 6");
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
    <title>Document</title>
    <script src="https://use.fontawesome.com/babe3a1cb6.js"></script>
</head>
<body>
    <!-- navabar -->
    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-success" href="#">
            <i class="fa fa-envira text-success"></i> Take My Herb
        </a>
        <div class="text-end">
            <button class="btn btn-success btn-sm mt-2" > Login </button>
            <button class="btn btn-outline-success btn-sm mt-2" > Register </button>    
        </div>
    </div>

    </nav>

    <!-- cta section -->
    <header class="text-center text-white masthead p-5" style="background:url('img/slide/2.jpg')no-repeat center center;background-size:cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="p-2"></div>
                <div class="col-xl-9 p-5 mx-auto position-relative">
                    <h1 class="mb-5"> Rileksasikan pikiran dengan obat-obatan herbal!</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto position-relative">
                    <form>
                        <div class="row">
                            <div class="col-12 col-md-3" style="margin: auto;">
                                <a href="index.php">
                                    <button class="btn btn-success btn-lg " style="margin: auto;" type="submit">Jelajahi</button>
                                </a>     
                            </div>
                        </div>
                        <div class="p-5"></div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!-- advantage section -->
    <section class="text-center bg-light features-icons p-5">
        <div class="container">
            <div class="p-3">
                <h2 class="mb-5 text-success">Kelebihan obat-obatan herbal...</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
                        <div class="d-flex features-icons-icon">
                            <i style="font-size:60px; text-align:center; margin:auto;" class="fa fa-heartbeat text-success"></i>
                        </div>
                        <h3 class="text-success">Sehat</h3>
                        <p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto features-icons-item mb-5 mb-lg-0 mb-lg-3">
                        <div class="d-flex features-icons-icon pb-2">
                            <i style="font-size:60px; text-align:center; margin:auto;" class="fa fa-pagelines text-success"></i>
                        </div>
                        <h3 class="text-success">Alami</h3>
                        <p class="lead mb-0">Featuring the latest build of the new Bootstrap 4 framework!</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto features-icons-item mb-7 mb-lg-0 mb-lg-3">
                        <div class="d-flex features-icons-icon">
                            <i style="font-size:50px; text-align:center; margin:auto;" class="bi bi-emoji-laughing text-success"></i>
                        </div>
                        <h3 class="text-success">Berkhasiat</h3>
                        <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--produk termurah section  -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="p-3">
                <h2 class="mb-5 text-success text-center">Produk Termurah</h2>
            </div>
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-lg-12 col-md-8 ">
                        <div class="row">

                        <?php 
                        $keyword = "";
                        if(isset($_POST['keyword'])){
                            $keyword = $_POST['keyword'];
                        };

                        // pengambilan data produk sesuai dengan keyword
                        $produk = query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR manfaat LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'");

                        foreach($low_price_products as $row) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <a href="detailproduk.php?id_produk=<?=$row["id_produk"]?>" class="test">
                            <div class="card ">
                                <img src="img/<?=$row["foto"]; ?>.jpg" class="card-img-top" style="height: 200px; object-fit: cover;"  alt="<?=$row["nama_produk"]; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$row["nama_produk"]; ?>
                                        <span class="badge bg-success rectangle-pill"><?=$row["stok"]; ?></span>
                                    </h5> 
                                    <div class="text-truncate">
                                        <?=$row["deskripsi"]; ?>
                                    </div>
                                    <p class="font-monospace text-black"> Rp.<?=$row["harga"]; ?>,00</p>
                                    <a href="index.php">
                                        <button class="btn btn-success btn-sm mt-2" value="Checkout" name="checkout"> Beli sekarang </button>
                                    </a>
                                </div>
                                </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- people section
    <section class="text-center bg-light testimonials p-5">
        <div class="container">
            <h2 class="mb-5 text-success">Apa yang pembeli katakan...</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" style="height: 170px;" src="img/profile/1.jpg">
                        <h5>Margaret E.</h5> membeli <span class="fw-bold text-success"> Kemangi </span>
                        <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" style="height: 170px;" src="img/profile/1.jpg">
                        <h5>Fred S.</h5> membeli <span class="fw-bold text-success"> Kemangi </span>
                        <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" style="height: 170px;" src="img/profile/1.jpg">
                        <h5>Sarah W.</h5> membeli <span class="fw-bold text-success"> Kemangi </span>
                        <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


        <!-- MDBootstrap footer -->
        <footer class="text-center text-white" style="background-color: #f1f1f1;">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
            <!-- Facebook -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fa fa-instagram"></i
            ></a>
            <!-- Github -->
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center fs-6 text-dark mt-2 p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">TakeMyHerb</a>
        </div>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>