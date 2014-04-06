<?php

namespace Club\ExtraBundle\Helper;

class Distance
{
    private $result;

    private $metric = 'meter';

    public function calculate($lat1, $lat2, $lng1, $lng2)
    {
        $earthRadius = 3958.75;

        $dLat = deg2rad($lat2-$lat1);
        $dLng = deg2rad($lng2-$lng1);


        $a = sin($dLat/2) * sin($dLat/2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $dist = $earthRadius * $c;

        if ($this->metric == 'meter') {
            $meterConversion = 1609;
        } else {
            $meterConversion = 1000;
        }

        $geopointDistance = $dist * $meterConversion;

        $this->result = $geopointDistance;
    }

    public function getResult()
    {
        return $this->result;
    }
}
