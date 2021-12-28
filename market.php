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

    $jumlah = query("SELECT COUNT(*) AS total FROM produk;")[0];
    $produk_types = query("SELECT tipe, COUNT(*) AS jumlah FROM produk GROUP BY tipe;");

    $minmax_harga = query("SELECT MIN(harga) AS harga_min, MAX(harga) AS harga_max  FROM produk;")[0];

?>
<!DOCTYPE html>
<html>
<head>
<title>Produk</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css?php echo time(); ?>">

<!-- JQueryUI -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<script>
  $(function() {
    
  } );
</script>

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

    <div class="py-3 container col-12 mb-4">
        <div class="row">
            <div class="col-lg-3 col-md-4"> 
                
                <div>
                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                        Semua Produk
                        <span class="badge bg-success rounded-pill"><?= $jumlah['total']; ?></span>
                    </a>
                </div>    


                <div class="list-group">
					<h3>Harga</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="<?= $minmax_harga['harga_max']?>" />
                    <p id="price_show"><?=$minmax_harga['harga_min'] ?>- <?= $minmax_harga['harga_max']?></p>
                    <div id="price_range"></div>
                </div>  

                <div class="list-group">
                    <h3>Tipe</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php foreach($produk_types as $row) : ?>
                        <div class="list-group-item checkbox">
                            <label> <input type="checkbox" class="common_selector type" value="<?php echo $row['tipe']; ?>" > <?php echo $row['tipe']; ?> </label>
                            <span class="badge bg-success rounded-pill"><?=$row["jumlah"]; ?></span>
                        </div>
                    <?php endforeach; ?>
                    </div>               
                </div>
                <div class="list-group">
                    <h3>Urut berdasarkan</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <div class="list-group-item checkbox">
                            <!-- <input type="hidden" name="check[0]" value="0" /> -->
                            <!-- <label> <input type="checkbox" class="common_selector sort_view" name="check[0]" value="view" > View </label> -->
                            <!-- <label> <input type="checkbox" class="common_selector sort_date" value="date" > Tanggal </label> -->
                        </div>
                    </div>               
                </div>

            </div>
            <div class="col-lg-9 col-md-8 ">
                <div class="row filter_data"></div>
            </div>
        </div>
    </div>

    <!-- Menampilkan produk -->
    
    
    <style>
    #loading
    {
        text-align:center; 
        background: url('img/gif/loader.gif') no-repeat center; 
        height: 150px;
    }
    </style>
    <script>
        $(document).ready(function(){

            filter_data();

            function filter_data()
            {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var type = get_filter('type');
                var keyword = $("#keyword").val();
                var view = $('.sort_view').val();
                console.log(view);
                // var ram = get_filter('ram');
                // var storage = get_filter('storage');
                $.ajax({
                    url:"loadproduk.php",
                    method:"POST",
                    data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, type:type, keyword: keyword},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function(){
                filter_data();
            });
        
            $('#price_range').slider({
                range:true,
                min:<?= $minmax_harga['harga_min']?>,
                max:<?= $minmax_harga['harga_max']?>,
                values:[<?= $minmax_harga['harga_min']?>, <?= $minmax_harga['harga_max']?>],
                step:500,
                stop:function(event, ui)
                {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

            $('#keyword').keyup(function(){
			    filter_data();
		    });
        







		// load_data();
		// function load_data(keyword)
		// {
        //     $.ajax({
        //         method:"POST",
		// 		url:"loadproduk.php",
		// 		data: {keyword: keyword},
		// 		success:function(hasil)
		// 		{
        //             $('#loadproduct').html(hasil);
		// 		}
		// 	});
	 	// }
		// $('#keyword').keyup(function(){
    	// 	var keyword = $("#keyword").val();
		// 	load_data(keyword);
		// });


	});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>