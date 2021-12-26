<?php
    require('config.php');

    session_start();

    if(!isset($_SESSION['username'])){
        echo "<script>alert('Anda belum melakukan login!')
            window.location.replace('index.php')
        </script>";
    }
    else {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id_user'] != 0){
                echo "<script>alert('Anda tidak memiliki izin akses pada halaman ini!')
                    window.location.replace('market.php')
                </script>";
            }
        }
    };

    $user = query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>User</title>
</head>
<body class="body">
<div class="container-fluid py-5">
        <div class="container">
            <div class="col-12 mb-4">
                <div class="row">

                    <?php include('_sidebar.php'); ?>


					<div class="col-lg-9 col-md-8 ">
                        
                        <h1 class="text-center">Data Akun</h1>
                        <!-- Pencarian -->
                        
                        <input class="user--search--bar" type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">

                        <!-- menampilkan table -->
                        <div class="table"></div>

                    </div>
            </div>
        </div>
    </div>
</div>


    <script>
        $(document).ready(function(){
		load_data();
		function load_data(keyword)
		{
            $.ajax({
                method:"POST",
				url:"loaduser.php",
				data: {keyword: keyword},
				success:function(hasil)
				{
                    $('.table').html(hasil);
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