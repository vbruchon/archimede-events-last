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
        $diffInHumans = $now->diffForHumans($newDate);

        if ($diffInDays > 365) {
            $diffInYears = floor($diffInDays / 365);
            $phrase = 'Dans ' . $diffInYears . ' an(s)';
        } elseif ($diffInDays > 30) {
            $diffInMonths = floor($diffInDays / 30);
            $phrase = 'Dans ' . $diffInMonths . ' mois';
        } elseif ($diffInDays > 0) {
            $phrase = 'Dans ' . $diffInDays . ' jour(s)';
        } elseif ($diffInDays === 0) {
            $phrase = 'Demain';
        } else {
            $phrase = $diffInHumans;
        }

        return $phrase;
    }

    public function convertDateToDays($date)
    {
        $newDate = Carbon::parse($date);

        return ucwords($newDate->isoFormat('dddd D MMMM Y'));
    }
}
