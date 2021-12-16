<table border="1" cellpadding="10" cellspacing="0">
    <!-- Pencarian -->
   
    <?php
    require ('config.php');
    $keyword = "";
    if(isset($_POST['keyword'])){
        $keyword = $_POST['keyword'];
    };

    $user = query("SELECT * FROM user WHERE nama_user LIKE '%$keyword%' OR email LIKE '%$keyword%' OR username LIKE '%$keyword%' OR hp LIKE '%$keyword%'");

    ?>
    <?php
    // inisialisasi nilai jumlah data
    $jumlah = query("SELECT COUNT(*) FROM user WHERE nama_user LIKE '%$keyword%' OR email LIKE '%$keyword%' OR username LIKE '%$keyword%' OR hp LIKE '%$keyword%'")[0];
    ?>

    <!-- menampilkan jumlah user -->
    <a>Jumlah user: <?php echo $jumlah["COUNT(*)"];?>
    <?php foreach($user as $row) : ?>
        <div class="container mt-3 mb-3">
            <div class="d-flex row">
                <div class="col-md-12">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-2 mt-1 mr-3 text-end">
                            <img class="img-fluid img-responsive rounded product-image" style="height: 160px;" src="img/profile/2.jpg"></div>
                        <div class="col-md-8 mt-1">
                            <h5><?=$row["nama_user"]; ?></h5>
                            Email :<p class="text-justify para mb-0"> <?=$row["email"]; ?> <br></p>
                            Username : <?=$row["username"]; ?> <br>
                            No HP : <?=$row["hp"]; ?> <br>
                        </div>
                        <div class="align-items-center align-content-center col-md-2 border-left mt-1">
                            <div class="d-flex flex-row align-items-center" style="font-size: 30px;">
                                <a href="editprofile.php?id_user=<?=$row["id_user"]; ?>"> <i class="bi bi-pencil-square text-success"></i> </a> 
                                <a href="deleteuser.php?id_user=<?=$row["id_user"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill text-success"></i></a>
                            </div>
                            <div class="d-flex flex-column ">
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</table>