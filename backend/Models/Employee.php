
<?php
/**
 * Pseudo code for a Laravel Model
 * 
 * 
 * Assumptions
 * Employees have standard working hours each day (clock in, clock out)
 */
class Employee extends Model
{
    // the table associated with the model.
    protected $table = 'employee';
    protected $guarded = [];


    public function events($start_time, $end_time){
        return self::where('employee_id',$this->id)->get();
    }

    /**
     * $start_time (datetime)
     * $end_time (datetime)
     * 
     * returns an int representing availibity every 5 mins
     */
    // get events every  5 mins from start to end
        // if appointments >= capacity || on_break
        //      slot not available
        // else
        //  available 
    public function getAvailibilty($start_time, $end_time, $total_possible = false){
        $timeStep  = 5;
        $timeSlots = [];
        $events  = $this->events();

        //adjust the start and end time to fit within employee work day
        if($start_time <= $this->clock_in){
            $start_time = $this->clock_in;
        }
        if($this->clock_out <= $end_time){
            $end_time = $this->clock_out;
        }

        while($startTime <= $endTime){
              //set availibty to employees capicty take availity away as timeslots fill
              $av = $this->capacity;
              $start_plus_5 = $startTime->add(new \DateInterval('PT'.$timeStep.'M'));

              for($events as  $key => $event){
                //check to see  if the event time overlaps with 
                if($start_time <= $event->end_at && $event->start_at <= $start_plus_5){
                    //if a match is found and it is a "break" auto set availibility to 0
                    if($event->type == 'break'){
                        $av = 0;
                        //break out of loop if on break since there is no availbility 
                        break;
                    }else{
                        // if total possible is true we only want to check for breaks, this  will get  us a total possible availibilty number
                        if(!$total_possible){
                            $av = $av - 1;
                        }
                           
                    }
                }
              }
              //push the availbility value to the array
              array_push($timeslots,$av)
              $startTime = $start_plus_5
            
        }
        //return the sum of the array
        return array_sum($timeSlots);
    
    }

    public function get_capacity_utilization($start_time, $end_time){
        $availbility= $this->getAvailibilty($start_time,$end_time);
        $total =  $this->getAvailibilty($start_time,$end_time, true);

        // return an array with the following info
        // [capacity_utilization, availbility, total possible availbility]
        return [$availbility / $total, $availbility, $total];

    }

    
 
}
