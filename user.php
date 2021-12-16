<?php
    require('config.php');
    $user = query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>User</title>
</head>
<body>

    <h1><ins>Data User</ins></h1>
    <br>

    <!-- Pencarian -->
    <b>Pencarian</b>
    <input type="text" name="keyword" id="keyword" autofocus placeholder="Cari" autocomplete="off">
    <br> 

    <!-- menampilkan table -->
    <div class="table"></div>

    <br><br><br><br><br>
    <br><br><br><br><br>
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