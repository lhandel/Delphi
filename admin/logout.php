<?php
    include '../function.php';
    // unset session a_id
    if (isset($_SESSION['a_id'])) {
        unset($_SESSION['a_id']);
    }
    header("Location: index.php");
?>
