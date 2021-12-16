<?php
    // menghubungkan dengan file config.php
    require 'config.php';

    if(isset($_GET["id_user"])){
        $id = $_GET["id_user"];
    
        // proses penghapusan data user dengan memanggil
        // fungsi hapususer
        if(hapususer($id)) {
            echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href='user.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href='user.php';
                </script>
            ";
        }
    }
