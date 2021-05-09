<?php
    require "thingy.php";

    $thingies = array();

    if (isset($_POST["thingies"])) {
        foreach ($_POST["thingies"] as $key => $value) {
            $thingies[] = new Thingy($value,$key);
        }
    }

    if (count($thingies) < 2) {
        $thingies = array();
        $thingies[] = new Thingy(0,"VALAKI");
        $thingies[] = new Thingy(0,"MÁSVALAKI");
    }

    $global_physics = new Physics($thingies, 0.1);

    if(isset($_POST["delete_pipes"])){
        foreach ($_POST["delete_pipes"] as $pipe) {
            unset($global_physics->pipes[$pipe]);
        }
    }

    foreach ($global_physics->pipes as $pipe) {
        $temp_pipes = $global_physics->pipes;
        unset($temp_pipes[array_search($pipe,$temp_pipes)]);
    }

    $global_physics->calc_steps_towards_common();

    echo serialize($global_physics);