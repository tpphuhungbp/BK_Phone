<?php
echo '<div class="comment-items">
    <div class="comment-item-left">
        <img src="./images/login.png" alt="sai duong dan" width="50%">
    </div>

    <div class="comment-item-right">
        <p class="comment-user">' .
    $_POST['name'] .
    '</p>
        <p class="comment-user">';
echo '<p>';
for ($i = 0; $i < $_POST['score']; $i++) {
    echo '⭐';
}

echo '</p>';

echo '<p class="comment-time">' .
    $_POST['time'] .
    '</p>
    <p class="comment-comment">' .
    $_POST['comment'] .
    '</p>
    </div>
</div>
<hr class="comment-hr">
';
?>
