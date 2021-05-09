<?php
    require_once "connect.php";
    require_once "console_log.php";

    $sql =
    "SELECT kik.nevem, SUM(kiadás)
    FROM költekezések AS k
    JOIN kik_vagyunk AS kik
    ON kik.id=k.id_ki_vagyok
    GROUP BY id_ki_vagyok"; 

    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetched = mysqli_fetch_all($result);

    $fetchedObject;

    mysqli_stmt_close($stmt);

    echo json_encode($fetched);
?>