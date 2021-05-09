<?php
    require_once "connect.php";
    require_once "console_log.php";

    $bad_price = false;
    $bad_name = false;

    $price = $_POST["price"];
    $desc = $_POST["desc"];
    $note = $_POST["note"];
    $who_name = $_POST["whoName"];

    if (!is_numeric($price)) {
        $bad_price = true;
    }

    $sql_for_id =
    "SELECT ki.id
    FROM kik_vagyunk AS ki
    WHERE ki.nevem=?"; 

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt,$sql_for_id);
    mysqli_stmt_bind_param($stmt, "s", $who_name);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $fetched = mysqli_fetch_assoc($result);

    if ($fetched == null) {
        $sql_insert = 
            "INSERT INTO kik_vagyunk (nevem)
            VALUES (?)";

            $stmt = mysqli_prepare($connection, $sql_insert);
            mysqli_stmt_bind_param($stmt, "s", $who_name);

            mysqli_stmt_execute($stmt);

            $who_id = mysqli_insert_id($connection);

            mysqli_stmt_close($stmt);
    }
    else {
        $who_id = $fetched["id"];
    }

    if (! $bad_price) {
        $sql = "INSERT INTO költekezések VALUES (DEFAULT, ?,?,?,?)";

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "issi", $price, $desc, $note, $who_id);

        mysqli_stmt_execute($stmt);        
        mysqli_stmt_close($stmt);
    }

    if ($bad_price) {
        echo "fail";
    }

    mysqli_close($connection);