<?php

namespace App\Traits;

trait SetPriodTraits {

    public function setperiod($period)
    {
        switch($period){
            case 'day':
                $period = today();
            break; 
            case 'week':
                $period = today()->subDays(7);
            break; 
            case 'month':
                $period = today()->subDays(30);
            break; 
            case 'all_time':
                $period = null;
            break; 
        }
        
        return $period;
    }
}

