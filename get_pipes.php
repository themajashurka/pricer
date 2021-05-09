<?php
    require "thingy.php";
    require 'unserilize_global_physics.php';

    $table = "";
    $row = "";

    foreach ($global_physics->pipes as $pipe) {
        $last_cell;
        if (true) {
            $last_cell = '<td onclick="deletePipe('.$pipe->id.')">törlés</td>';
        }
        else{
            $last_cell = '<td></td>';
        }
        $row = 
            '<tr>'.
                '<td>'.$pipe->first_thingy->name.'</td>'.
                '<td>'.$pipe->second_thingy->name.'</td>'.
                '<td>'.$pipe->big_Q_collected.'</td>'.
                $last_cell.
            '</tr>';
        $table .= $row;
    }

    echo json_encode($table);