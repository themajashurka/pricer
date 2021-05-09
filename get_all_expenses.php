<?php
    require_once "connect.php";
    require_once "console_log.php";

    $sql =
        "SELECT kik_vagyunk.nevem, költekezések.kiadás, költekezések.mit_vettem, költekezések.megjegyzés
        FROM költekezések
        JOIN kik_vagyunk
        ON költekezések.id_ki_vagyok=kik_vagyunk.id
        ORDER BY költekezések.id ASC"; 

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetched = mysqli_fetch_all($result);

    echo json_encode($fetched);

    mysqli_stmt_close($stmt);
?>