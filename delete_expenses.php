<?php
    require_once "connect.php";

    $sql = "DELETE FROM költekezések"; 

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);