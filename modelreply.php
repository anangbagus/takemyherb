<?php
require_once "config.php";
$action = $_POST['action'];
if($action = "add"){
    addreply();
}

function addreply(){
    $koneksi = mysqli_connect("localhost", "root", "", "takemyherb");
    $id_review = $_POST['id_review'];
    $text = $_POST['text'];
    $reviews = query("SELECT * FROM review WHERE id_review = $id_review");
    foreach($reviews as $review):
        $id_user = $review['id_user'];
        $id_produk = $review['id_produk'];
    endforeach;
    $query = "INSERT INTO reply (id_reply, id_user, id_produk, id_review, balasan, tgl_reply)
              VALUES (NULL, '$id_user', '$id_produk', '$id_review', '$text', NOW())";
    mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi)) {
    } else {
        die(header("HTTP/1.0 404 Not Found"));
    }
}



?>