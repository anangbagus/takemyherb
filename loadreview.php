<?php
require_once "config.php";

$id_produk = $_POST['id_produk'];
$reviews = query("SELECT r.*, u.* FROM review r INNER JOIN user u ON u.id_user = r.id_user WHERE id_produk = $id_produk ORDER BY tgl_review DESC");
?>

<div class="posted-comment">
    <label>Komentar:</label>
    <br>
    <table>
        <?php foreach($reviews as $review): ?>
            <tr id="review-<?= $review['id_review']; ?>">
                <td><?= $review['nama_user']; ?></td>
                <td><?= $review['ulasan']; ?></td>
                <td><?= $review['tgl_review']; ?></td>
                <td>
                    <button id="show-replybox-<?= $review['id_review']; ?>" class="reply">Balas</button>
                    <?php if(cekreply($review['id_review']) != 0){ ?>
                        <button id="show-reply-<?= $review['id_review']; ?>" class="show-reply">Lihat Balasan</button>
                    <?php } ?>
                </td>
            </tr>
            <!-- Show Reply if Exist -->
            <tr class="replies-<?= $review['id_review']; ?>" hidden>
                <td colspan="4"></td>
            </tr>
            <!-- Reply Form -->
            <tr id="replybox-<?= $review['id_review']; ?>" hidden>
                <td colspan="4">
                    <label>Berikan balasan anda:</label>
                    <br>
                    <input type="text" name="reply" id="text-reply-<?= $review['id_review']; ?>" placeholder="Reply...">
                    <button id="reply-<?= $review['id_review']; ?>" class="kirim-reply">Kirim</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    $(document).ready(function(){
        $('.reply').click(function(){
            var id = $(this).attr('id');
            var no_id = id.replace("show-replybox-",'');
            $('table').find('tr#replybox-'+no_id).show();
        });
        $('.kirim-reply').click(function(){
            var id = $(this).attr('id');
            var no_id = id.replace("reply-",'');
            var text = $('table').find('input#text-reply-'+no_id).val();
            $.ajax({
                method:"POST",
                url:"modelreply.php",
                data: {text: text, action: "add", id_review: no_id},
                success:function(response)
                {
                    alert("Balasan ditambahkan.");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
        $('.show-reply').click(function(){
            var id = $(this).attr('id');
            var no_id = id.replace("show-reply-",'');
            $('table').find('tr.replies-'+no_id).show();
            $.ajax({
                method:"POST",
                url:"loadreply.php",
                data: {id_review: no_id},
                success:function(hasil)
                {
                    $('tr.replies-'+no_id).find('td').html(hasil);
                }
            });
        });
    });
</script>