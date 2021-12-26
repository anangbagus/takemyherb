<?php
require "config.php";

$id_produk = $_POST['id_produk'];
$reviews = query("SELECT r.*, u.* FROM review r INNER JOIN user u ON u.id_user = r.id_user WHERE id_produk = $id_produk ORDER BY tgl_review DESC");
?>

<div class="posted-comment">
    <label>Komentar:</label>
    <br>
    <table>
        <?php foreach($reviews as $review): ?>
            <tr>
                <td><?= $review['nama_user']; ?></td>
                <td><?= $review['ulasan']; ?></td>
                <td><?= $review['tgl_review']; ?></td>
                <td id="<?= $review['id_review'] ?>">
                    <button>Balas</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>