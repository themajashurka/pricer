<?php
    require "thingy.php";
    require "unserilize_global_physics.php";

    echo round($global_physics->calc_common_temp(),1)." °C";