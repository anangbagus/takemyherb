<?php
$koneksi = mysqli_connect("localhost", "root", "", "takemyherb");

function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function hapususer($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");
    return mysqli_affected_rows($koneksi);
}

function cariuser($keyword){
    $query = "SELECT * FROM user 
                WHERE id_user LIKE '%$keyword%' OR
                nama_user LIKE '%$keyword%' OR
                email LIKE '%$keyword%'";
    return query($query);
}

function hapusproduk($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id'");
    return mysqli_affected_rows($koneksi);
}

function cariproduk($keyword){
    $query = "SELECT * FROM produk 
                WHERE nama_produk LIKE '%$keyword%'";
    return query($query);
}

function sorting($table, $keyword, $orderby){
    $query = "SELECT * FROM $table ORDER BY $orderby $keyword";
    return query($query);
}

function caritipeproduk($id){
    $query = "SELECT * FROM produk WHERE tipe='$id'";
    return query($query);
}

?>
