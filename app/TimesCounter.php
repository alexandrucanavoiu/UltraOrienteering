<?php

namespace App;

class TimesCounter {

    private $totaltime = '00:00:00';

    public function __construct($times){

        if(is_array($times)){

            $unixTime = 0;

            foreach($times as $time) {
                $unixTime += strtotime($time);
            }

            $this->totaltime = date('H:i:s', $unixTime);
        } else {
            // Do nothing
        }
    }

    public function get_total_time(){
        return $this->totaltime;
    }

}