<?php


if(!function_exists('parseBitToMegaBit')) {
    function parseBitToMegaBit(int $bits, int $maxFloatingPoint = 2)
    {
        $megaBits = $bits / 1000 / 1000;

        return number_format($megaBits, $maxFloatingPoint);
    }
}
if(!function_exists('evaluateColorJatuhTempo')) {
    function evaluateColorJatuhTempo(\Carbon\Carbon | null $jatuh_tempo)
    {
        $currentDate = \Carbon\Carbon::now();

        $diff = ($jatuh_tempo) ? $currentDate->diffInDays($jatuh_tempo) : null;
        switch(true) {
            case (is_null($diff)):
                echo "black flag";
                break;
            case ($diff > 7):
                echo "text-green-500";
                break;
            case ($diff > 0 && $diff < 7):
                echo "text-yellow-500";
                break;
            case ($diff <= 0):
                echo "text-red-500";
                break;
            default:
                echo "black flag";
                break;
        }
    }
}


