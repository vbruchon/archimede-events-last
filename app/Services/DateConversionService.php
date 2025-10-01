<?php

namespace App\Services;


use Carbon\Carbon;




class DateConversionService
{
    public function convertDateToString($date)
    {
        $newDate = Carbon::parse($date);
        $now = Carbon::now();
        $diffInDays = $now->diffInDays($newDate, false);

        if ($diffInDays > 365) {
            $diffInYears = floor($diffInDays / 365);
            $phrase = 'Dans ' . $diffInYears . ' an(s)';
        } elseif ($diffInDays > 30) {
            $diffInMonths = floor($diffInDays / 30);
            $phrase = 'Dans ' . $diffInMonths . ' mois';
        } elseif ($diffInDays > 0) {
            $phrase = 'Dans ' . $diffInDays . ' jour(s)';
        } elseif ($diffInDays === 0) {
            $phrase = 'Aujourd\'hui';
        } elseif ($diffInDays < -365) {
            $diffInYears = floor(abs($diffInDays) / 365);
            $phrase = 'Il y a ' . $diffInYears . ' an(s)';
        } elseif ($diffInDays < -30) {
            $diffInMonths = floor(abs($diffInDays) / 30);
            $phrase = 'Il y a ' . $diffInMonths . ' mois';
        } else {
            $phrase = 'Il y a ' . abs($diffInDays) . ' jour(s)';
        }

        return $phrase;
    }


    public function convertDateToDays($date)
    {
        $newDate = Carbon::parse($date);

        return ucwords($newDate->isoFormat('dddd D MMMM Y'));
    }
}
