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

    // inisialisasi nilai jumlah data
    $jumlah = query("SELECT COUNT(*) FROM produk")[0];
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>produk</title>
</head>
<body>

    <h1><ins>Data produk</ins></h1>
    <br>

    <!-- Pencarian -->
    <b>Pencarian</b>
    <input type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
    <br> 

    <br> <br>

    <!-- menampilkan table -->
    <table border="1" cellpadding="10" cellspacing="0"></table>
    <br> <br>

    <!-- menampilkan jumlah produk -->
    <a>Jumlah produk: <?php echo $jumlah["COUNT(*)"];?>

    <br><br><br><br><br>
    <br><br><br><br><br>
    <a href="keranjang.php">Keranjang</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php" class="btn">Logout</a>

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
                    $('table').html(hasil);
				}
			});
	 	}
		$('#keyword').keyup(function(){
    		var keyword = $("#keyword").val();
			load_data(keyword);
		});
	});
    </script>
</body>
</html>