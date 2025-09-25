<?php

namespace App\Services;

use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Carbon\Carbon;




class EventExportFileService
{
    public function exportToICS($events)
    {
        // Créez un nouveau calendrier
        $calendar = Calendar::create('Archimède Event to Calendar');

        // Ajoutez chaque événement au calendrier
        foreach ($events as $event) {
            $calendar->event(
                Event::create()
                    ->name($event->name)
                    ->startsAt(Carbon::parse($event->date_start))
                    ->endsAt(Carbon::parse($event->date_end))
            );
        }

        return $calendar->get();
    }
}
