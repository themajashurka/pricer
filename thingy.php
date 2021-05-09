<?php
    $global_physics;

    class Pipe{
        public $id;
        public $big_Q;
        public $big_Q_collected = 0;
        public $first_thingy;
        public $second_thingy;
        public $enabled;
        public $deletable;

        function __construct($first_thingy, $second_thingy){
            $this->first_thingy = $first_thingy;
            $this->second_thingy = $second_thingy;
        }
    }

    class Thingy{
        public $id;
        public $name;
        public $temp;
        public $temp_init;
        public $big_Q_collected = 0;

        function __construct($temp,$name){
            $this->temp = $temp;
            $this->name = $name;
            $this->temp_init = $temp;
        }
    }

    class Physics{
        public $thingies;
        public $pipes;
        public $timestep;
        public $steps;
        public $snapshots;

        function __construct($thingies, $timestep){
            $this->thingies = $thingies;
            $this->timestep = $timestep;

            for ($i=0; $i < count($this->thingies); $i++) { 
                $this->thingies[$i]->id = $i;
            }

            $num_of_pipes = 
            (count($this->thingies)-1)*count($this->thingies)/2;

            $first_thingy_i = 0;
            $second_thingy_i = 1;
            $minus_from_count = count($this->thingies)-2;

            for ($i=0; $i < $num_of_pipes; $i++) { 
                $this->pipes[] = new Pipe(
                $this->thingies[$first_thingy_i],
                $this->thingies[$second_thingy_i]);
                
                end($this->pipes)->id = $i;

                $second_thingy_i++;
                if($second_thingy_i == count($this->thingies)){
                    $second_thingy_i = count($this->thingies)-$minus_from_count;
                    $first_thingy_i++;
                    $minus_from_count--;
                }
            }
        }

        function calc_common_temp(){
            $total_mass = count($this->thingies);
            $total_heat_capacity = 0;
            foreach($this->thingies as $thingy){
                $total_heat_capacity += $thingy->temp;
            }
            return $total_heat_capacity/$total_mass;
        }

        function calc_steps_towards_common(){
            $error = 100;
            $i=0;
            while($error > 0.01) {
                $snapshot = array_column($this->thingies,'temp');
                $this->snapshots[] = $snapshot;

                foreach ($this->pipes as $pipe) {
                    $th1 = $pipe->first_thingy;
                    $th2 = $pipe->second_thingy;

                    $pipe->big_Q=($th1->temp - $th2->temp)*$this->timestep;
                    $th1->big_Q_collected -= $pipe->big_Q;
                    $th2->big_Q_collected += $pipe->big_Q;

                    $pipe->big_Q_collected += $pipe->big_Q;
                }

                foreach($this->pipes as $pipe){
                    $th1 = $pipe->first_thingy;
                    $th2 = $pipe->second_thingy;

                    $th1->temp -= $pipe->big_Q;
                    $th2->temp += $pipe->big_Q;
                }
                $error = 0;
                foreach ($this->pipes as $pipe) {
                    $error += abs($pipe->big_Q);
                }
                $error /= count($this->pipes);
            }

            foreach ($this->thingies as $thingy) {
                $thingy->big_Q_collected = round($thingy->big_Q_collected,0);
            }
            foreach ($this->pipes as $pipe) {
                $pipe->big_Q_collected = round($pipe->big_Q_collected,0);
            }
        }
    }