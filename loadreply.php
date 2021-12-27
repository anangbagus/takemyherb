<?php
require_once "config.php";

$id_review = $_POST['id_review'];
$replies = query("SELECT * FROM reply WHERE id_review = '$id_review'");
?>

<table>
<?php foreach($replies as $reply): ?>
    <tr>
        <td><?= $reply['id_user']; ?></td>
        <td colspan="3"><?= $reply['balasan']; ?></td>
    </tr>
<?php endforeach; ?>
</table>