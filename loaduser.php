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
        <div class="user--card container col-md-12 mt-3 mb-3">
            <div class="row p-2 bg-white">
                <div class="col-md-2 mt-1">
                    <img class="user--image img-fluid img-responsive rounded product-image" src="img/profile/<?=$row["image"]; ?>"></div>
                <div class="col-md-8">
                    <table>
                        <tr>
                            <th>
                                <h5><?=$row["nama_user"]; ?></h5>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                            <p class="text-justify para mb-0"> <?=$row["email"]; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Username
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <?=$row["username"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                No HP
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                <?=$row["hp"]; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="user--button col-md-2 border-left mt-1 d-flex flex-row align-items-center justify-content-evenly">
                        <a class="align-self-center" href="editprofile.php?id_user=<?=$row["id_user"]; ?>"> <i class="bi bi-pencil-square text-success"></i> </a> 
                        <a class="align-self-center" href="deleteuser.php?id_user=<?=$row["id_user"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash-fill text-success"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>