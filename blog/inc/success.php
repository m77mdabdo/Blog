<?php
if (isset($_SESSION['success'])) {
    $messages = $_SESSION['success'];
    if (is_array($messages)) {
        echo "<div class='alert alert-success'>" . implode("<br>", $messages) . "</div>";
    } else {
        echo "<div class='alert alert-success'>$messages</div>";
    }
    unset($_SESSION['success']); // مسح الجلسة بعد العرض
}
?>
