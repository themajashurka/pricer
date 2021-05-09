<?php
    require "thingy.php";
    require "unserilize_global_physics.php";

    $matrixPipes;

    foreach ($global_physics->pipes as $pipe) {
        $matrixPipes[$pipe->first_thingy->id][$pipe->second_thingy->id] = 
            $pipe->big_Q_collected;
    }

    $first_row_datas = "";
    for ($i=0; $i < count($global_physics->thingies); $i++) { 
        $first_row_datas .= "<th><div>".$global_physics->thingies[$i]->name."</div></th>";
    }

    $first_row = '<tr><th style="border-right: 2px solid red;"></th>'.$first_row_datas."</tr>";

    $main_rows = $first_row;
    for ($i=0; $i < count($global_physics->thingies); $i++) {
        $main_rows_datas = "";
        for ($j=0; $j < count($global_physics->thingies); $j++) {
            $data;
            if(!isset($matrixPipes[$i][$j])) $data = "";
            else $data = $matrixPipes[$i][$j];
            $main_rows_datas .= "<td>".$data."</td>";
        } 
        $main_rows .= '<tr><th class="vertical"><div>'.
            $global_physics->thingies[$i]->name."</div></th>".$main_rows_datas;
    }

    echo json_encode($main_rows);