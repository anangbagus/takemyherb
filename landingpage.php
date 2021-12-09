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

    <link rel="stylesheet" href="css/style.css">
    
    <title>Document</title>
</head>
<body>


    <!-- MDB Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="">
        <i class="fas fa-seedling text-success tw-bold " style="font-size:2.6rem;"></i>
        </a>

        <!-- Toggle button -->
        <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link  text-success fw-bold" href="#">TakeMyHerb</a>
            </li>
        </ul>
        <!-- Left links -->

        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-link px-3 me-2 text-success">
            <a class="fs-6 text-success" href="index.php">Login</a>
            </button>
            <a class="fs-6" href="register.php">
            <button type="button text-white" class="btn btn-success me-3">
            Sign up for free 
            </button>
            </a>
        </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <!-- MDB Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-mdb-ride="carousel">
        <div class="carousel-indicators">
            <button
            type="button"
            data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
            ></button>
            <button
            type="button"
            data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide-to="1"
            aria-label="Slide 2"
            ></button>
            <button
            type="button"
            data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide-to="2"
            aria-label="Slide 3"
            ></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img
                src="img/slide/3.jpg"
                class="d-block w-100"
                alt="..."
            />
            </div>
            <div class="carousel-item">
            <img
                src="img/slide/2.jpg"
                class="d-block w-100"
                alt="..."
            />
            </div>
            <div class="carousel-item">
            <img
                src="img/slide/1.jpg"
                class="d-block w-100"
                alt="..."
            />
            </div>
        </div>
        <button
            class="carousel-control-prev"
            type="button"
            data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="prev"
        >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="next"
        >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>


        <!-- MDBoostrap Product Low Price -->
        <h2 class="mb-3 text-center">Produk Termurah<h2/>
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">

                <?php foreach($low_price_products as $row ): ?>
                
                    <div class="col-md-12 col-lg-4 mb-4 pb-4 mb-lg-0">
                    <div class="card">
                    
                    <!-- photo -->
                    <img
                        src="img/<?=$row["foto"]; ?>.jpg" class="card-img-top img-product"
                        alt="laptop"
                    />
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <!-- type -->
                            <h6><a href="#!" class="text-muted"><?=$row["tipe"]; ?></a></h6>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <!-- title -->
                            <h5 class="mb-0 text-success"><?=$row["nama_produk"]; ?></h5>
                            <!-- price -->
                            <h5 class="text-dark fw-bold mb-0"><?=$row["harga"]; ?></h5>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <!-- stock -->
                            <h6 class="text-muted mb-0">Available: <span class=""><?=$row["stok"]; ?></span></h6>
                        
                        </div>
                    </div>
                    </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            </section>


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
                ><i class="fab fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
            ></a>

            <!-- Linkedin -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-linkedin"></i
            ></a>
            <!-- Github -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-github"></i
            ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center fs-6 text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">TakeMyHerb</a>
        </div>
        </footer>

    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.js"
    ></script>
</body>
</html>