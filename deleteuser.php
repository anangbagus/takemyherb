<?php
    // menghubungkan dengan file config.php
    require 'config.php';

    $id = $_GET["id_user"];

    // proses penghapusan data user dengan memanggil
    // fungsi hapususer
    if(hapususer($id)>0) {
        echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href='user.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus');
                document.location.href='user.php';
            </script>
        ";
    }
