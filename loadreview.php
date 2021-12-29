<?php
require_once "config.php";

$id_produk = $_POST['id_produk'];
$reviews = query("SELECT r.*, u.* FROM review r INNER JOIN user u ON u.id_user = r.id_user WHERE id_produk = $id_produk ORDER BY tgl_review DESC");
?>

<div class="detail--review">
    <div class="detail--review--title mb-3">
        <h3>
            Review 
        </h3>
    </div>
    <table>
    <?php foreach($reviews as $review): ?>
        <tr>
            <td>
                <div class="detail--review--name">
                    <p>
                        <b><?= $review['nama_user']; ?></b>
                        pada <?= $review['tgl_review']; ?>
                    </p>
                </div>
                <div class="detail--review--opinion">
                    <p>
                        <?= $review['ulasan']; ?> 
                    </p>
                </div>
                <div class="detail--review--button">
                    <button id="show-replybox-<?= $review['id_review']; ?>" class="detail--button reply">Balas</button>
                    <?php if(cekreply($review['id_review']) != 0){ ?>
                        <button id="show-reply-<?= $review['id_review']; ?>" class="detail--button show-reply">Lihat Balasan</button>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <!-- Show Replies -->
        <tr class="replies-<?= $review['id_review']; ?>" hidden>
            <td></td>
        </tr>
        <!-- Reply Form -->
        <tr id="replybox-<?= $review['id_review']; ?>" hidden>
            <td>
                <label>Berikan balasan anda:</label>
                <br>
                <input type="text" name="reply" id="text-reply-<?= $review['id_review']; ?>" placeholder="Reply...">
                <button id="reply-<?= $review['id_review']; ?>" class="detail--button kirim-reply">Kirim</button>
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
            $('table').find('tr#replybox-'+no_id).removeAttr('hidden');
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
            $('table').find('tr.replies-'+no_id).removeAttr('hidden');
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