<?php
$koneksi = mysqli_connect("localhost", "root", "", "takemyherb");

// fungsi untuk mengirim query ke database
// dan mengembalikan nilai berupa array
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

// fungsi untuk menghapus data user
function hapususer($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");
    return mysqli_affected_rows($koneksi);
}

// fungsi untuk mencari data user
function cariuser($keyword){
    $query = "SELECT * FROM user 
                WHERE id_user LIKE '%$keyword%' OR
                nama_user LIKE '%$keyword%' OR
                email LIKE '%$keyword%'";
    return query($query);
}

// fungsi untuk menghapus data produk
function hapusproduk($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id'");
    return mysqli_affected_rows($koneksi);
}

// fungsi untuk mencari data produk
function cariproduk($keyword){
    $query = "SELECT * FROM produk 
                WHERE nama_produk LIKE '%$keyword%'";
    return query($query);
}

// fungsi untuk melakukan sorting pada data
function sorting($table, $keyword, $orderby){
    $query = "SELECT * FROM $table ORDER BY $orderby $keyword";
    return query($query);
}

// fungsi untuk melakukan pencarian produk berdasarkan tipe
function caritipeproduk($id){
    $query = "SELECT * FROM produk WHERE tipe='$id'";
    return query($query);
}

?>
