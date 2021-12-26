<?php
    require('config.php');

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    };

    $produk = query("SELECT id_produk, nama_produk, manfaat, harga, deskripsi, stok, foto, tipe FROM produk");

    // jika menekan tombol cari
    if(isset($_POST["cari"])){
        $produk = cariproduk($_POST["keyword"]);
    }

    // jika menekan tombol carikategori
    if(isset($_POST["carikategori"])){
        $produk = caritipeproduk($_POST["kategori"]);
    }

    
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css?php echo time(); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Produk</title>
</head>
<body>

    <?php include('_header.php'); ?>

    <div class="col-12 product--header container">
        <div class="row">
            <div class="col-lg-4 product--header--search">
                <form class="">
                    <input type="text" placeholder="Cari produk..." class="market--search" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
                    <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
                </form>
            </div>
            <div class="col-lg-7 d-flex justify-content-center align-item-center product--header--title">
                <h2 class="">Produk Kami</h2>
            </div>
        </div>
    </div>
        

    <!-- Menampilkan produk -->
    <div id="loadproduct"></div>
    <br>

    <script>
        $(document).ready(function(){
		load_data();
		function load_data(keyword)
		{
            $.ajax({
                method:"POST",
				url:"loadproduk.php",
				data: {keyword: keyword},
				success:function(hasil)
				{
                    $('#loadproduct').html(hasil);
				}
			});
	 	}
		$('#keyword').keyup(function(){
    		var keyword = $("#keyword").val();
			load_data(keyword);
		});
	});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>