<?php
    require_once "connect.php";
    require_once "console_log.php";

    $sql =
        "SELECT kik_vagyunk.nevem
        FROM kik_vagyunk"; 

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetched = mysqli_fetch_all($result);

    echo json_encode($fetched);

    mysqli_stmt_close($stmt);
?>