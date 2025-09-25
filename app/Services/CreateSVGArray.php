<?php

namespace App\Services;


use Carbon\Carbon;




class createSVGArray
{
    function createSvgArray()
    {
        //Path to SVG file
        $structureSvgPath = public_path('image/structure-purple.svg');
        $partnerSvgPath = public_path('image/partners-purple.svg');
        $descriptionSvgPath = public_path('image/description.svg');
        $participantsSvgPath = public_path('image/groups-purple.svg');
        $dateSvgPath = public_path('image/date-purple.svg');
        $needSvgPath = public_path('image/needs.svg');
        $eventSvgPath = public_path('image/event.svg');
        $accessTypeSvgPath = public_path('image/accessType-purple.svg');
        $userSvgPath = public_path('image/user-purple.svg');
        $locateSvgPath = public_path('image/marker-purple.svg');
        $linkSvgPath = public_path('image/link-purple.svg');

        // Read the SVG file contents
        $structureSvgContents = file_get_contents($structureSvgPath);
        $structureSvg = str_replace('<svg', '<svg class="w-9 h-9"', $structureSvgContents);
        $partnerSvgContents = file_get_contents($partnerSvgPath);
        $partnerSvg = str_replace('<svg', '<svg class="w-9 h-9"', $partnerSvgContents);
        $descriptionSvgContent = file_get_contents($descriptionSvgPath);
        $descriptionSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $descriptionSvgContent);
        $particpantSvgContent = file_get_contents($participantsSvgPath);
        $particpantSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $particpantSvgContent);
        $dateSvgContent = file_get_contents($dateSvgPath);
        $dateSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $dateSvgContent);
        $needSvgContent = file_get_contents($needSvgPath);
        $needSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $needSvgContent);
        $eventSvgContent = file_get_contents($eventSvgPath);
        $eventSvg = str_replace('<svg', '<svg class="w-9 h-9"', $eventSvgContent);
        $accessTypeSvgContent = file_get_contents($accessTypeSvgPath);
        $accessTypeSvg = str_replace('<svg', '<svg class="w-9 h-9"', $accessTypeSvgContent);
        $userSvgContent = file_get_contents($userSvgPath);
        $userSvg = str_replace('<svg', '<svg class="w-9 h-9"', $userSvgContent);
        $locateSvgContent = file_get_contents($locateSvgPath);
        $locateSvg = str_replace('<svg', '<svg class="w-9 h-9"', $locateSvgContent);
        $linkSvgContent = file_get_contents($linkSvgPath);
        $linkSvg = str_replace('<svg', '<svg class="w-9 h-9"', $linkSvgContent);

        return [
            'structure' => $structureSvg,
            'partners' => $partnerSvg,
            'description' => $descriptionSvg,
            'participants' => $particpantSvg,
            'date' => $dateSvg,
            'needs' => $needSvg,
            'event' => $eventSvg,
            'accessType' => $accessTypeSvg,
            'user' => $userSvg,
            'locate' => $locateSvg,
            'link' => $linkSvg,
        ];
    }
}
