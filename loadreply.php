<?php
require_once "config.php";

$id_review = $_POST['id_review'];
$replies = query("SELECT r.*, u.* FROM reply r INNER JOIN user u ON u.id_user = r.id_user WHERE id_review = '$id_review'");
?>

<table>
<?php foreach($replies as $reply): ?>
    <tr>
        <td><?= $reply['username']; ?></td>
        <td colspan="3"><?= $reply['balasan']; ?></td>
    </tr>
<?php endforeach; ?>
</table>