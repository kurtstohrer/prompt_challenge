<?php

/**
 * Assumptions
 * employees and events are eloquent models 
 * the below function is used to aggregate a number for multple employees rather then a sigle 1
 */

 public function get_capacity_utilization($employees = [], $start_at, $end_at){
     $total_avail = 0;
     $total_possible = 0;
     
     foreach($employees as $key => $employee){
        $capacity_utilization = $employee->get_capacity_utilization()
        $total_availbility += $capacity_utilization[1];
        $total_possible +=  $capacity_utilization[2];
        $employee->capacity_utilization  = $capacity_utilization[0];
     }

     // return an array with the following info
     // [total capacity_utilization, availbility, list of employees and thier utilization]
     return [$total_avail / $total_possible, $employees]

 }