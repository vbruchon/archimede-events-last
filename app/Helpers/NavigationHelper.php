<?php

namespace App\Helpers;

use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminEventController;


class NavigationHelper
{
    public static function getNavigationLinks()
    {
        if (auth()->check()) {
            $links[] = [
                'url' => route('dashboard'),
                'label' => 'Tableau de bord',
                'svg' => '<svg fill="#f6f5f4" class="w-7" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <path d="M27 18.039L16 9.501 5 18.039V14.56l11-8.54 11 8.538v3.481zm-2.75-.31v8.251h-5.5v-5.5h-5.5v5.5h-5.5v-8.25L16 11.543l8.25 6.186z" />
                </g>
            </svg>'
            ];
            $user = auth()->user();
            $links[] = [
                'url' => route('userEvent.all'),
                'label' => 'Événements',
                'svg' => '<svg fill="#f6f5f4" xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path d="M46.5,20h-41C4.7,20,4,20.7,4,21.5V46c0,2.2,1.8,4,4,4h36c2.2,0,4-1.8,4-4V21.5C48,20.7,47.3,20,46.5,20z M19,42c0,0.6-0.4,1-1,1h-4c-0.6,0-1-0.4-1-1v-4c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1V42z M19,32c0,0.6-0.4,1-1,1h-4 c-0.6,0-1-0.4-1-1v-4c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1V32z M29,42c0,0.6-0.4,1-1,1h-4c-0.6,0-1-0.4-1-1v-4c0-0.6,0.4-1,1-1h4 c0.6,0,1,0.4,1,1V42z M29,32c0,0.6-0.4,1-1,1h-4c-0.6,0-1-0.4-1-1v-4c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1V32z M39,42 c0,0.6-0.4,1-1,1h-4c-0.6,0-1-0.4-1-1v-4c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1V42z M39,32c0,0.6-0.4,1-1,1h-4c-0.6,0-1-0.4-1-1v-4 c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1V32z" />
                        <path d="M44,7h-4h-1V5c0-1.6-1.3-3-3-3l0,0c-1.6,0-3,1.3-3,3v2H19V5c0-1.6-1.3-3-3-3l0,0c-1.6,0-3,1.3-3,3v2h-1H8 c-2.2,0-4,1.8-4,4v2.5C4,14.3,4.7,15,5.5,15h41c0.8,0,1.5-0.7,1.5-1.5V11C48,8.8,46.2,7,44,7z" />
                    </g>
                </g>
            </svg>'
            ];
            if ($user->is_admin) {
                // Liens pour les administrateur
                $links[] = [
                    'url' => route('admin.structure.list'),
                    'label' => 'Structures',
                    'svg' => '<svg fill="#f6f5f4" class="w-7" viewBox="-3.2 -3.2 38.40 38.40" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192" />
                        <g id="SVGRepo_iconCarrier">
                            <path d="M30,25.11H29v-.89a2,2,0,0,0-2-2H26V14.11h1a2,2,0,0,0,2-2v-.89h2a1,1,0,0,0,.43-1.9l-15-7.22a1,1,0,0,0-.86,0L.57,9.32A1,1,0,0,0,1,11.22H3v.89a2,2,0,0,0,2,2H6v8.11H5a2,2,0,0,0-2,2v.89H2a2,2,0,0,0-2,2V29a1,1,0,0,0,1,1H31a1,1,0,0,0,1-1V27.11A2,2,0,0,0,30,25.11Zm-14-21L26.62,9.22H5.38Zm-11,8v-.89H27v.89H5Zm19,2v8.11H21.5V14.11Zm-4.5,0v8.11H17V14.11Zm-4.5,0v8.11H12.5V14.11Zm-4.5,0v8.11H8V14.11ZM5,24.22H27v.89H5ZM30,28H2v-.89H30Z" />
                        </g>
                    </svg>'
                ];

                $links[] = [
                    'url' => route('admin.numberOfParticipants.list'),
                    'label' => 'Nombre de participants',
                    'svg' => '<svg class="w-7" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#f6f5f4">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    <g id="SVGRepo_iconCarrier">
                        
                        <g data-name="79-users" id="_79-users">
                            <circle class="cls-2" cx="16" cy="13" r="5"/>
                            <path class="cls-2" d="M23,28A7,7,0,0,0,9,28Z"/>
                            <path class="cls-2" d="M24,14a5,5,0,1,0-4-8"/>
                            <path class="cls-2" d="M25,24h6a7,7,0,0,0-7-7"/>
                            <path class="cls-2" d="M12,6a5,5,0,1,0-4,8"/>
                            <path class="cls-2" d="M8,17a7,7,0,0,0-7,7H7"/>
                        </g>
                    </g>
                </svg>
                '
                ];
                $links[] = [
                    'url' => route('admin.tags.list'),
                    'label' => 'Tags',

                    'svg' => '<svg class="w-7 bi bi-tags-fill" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)">

                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    
                    <g id="SVGRepo_iconCarrier"> <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/> <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/> </g>
                    
                    </svg>
                '
                ];
                $links[] = [
                    'url' => route('admin.accessType.list'),
                    'label' => 'Accès',
                    'svg' => '<svg fill="#ffffff" class="w-7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24">

                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    
                    <g id="SVGRepo_iconCarrier">
                    
                    <path d="M17,9V7c0-2.8-2.2-5-5-5S7,4.2,7,7v2c-1.7,0-3,1.3-3,3v7c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3v-7C20,10.3,18.7,9,17,9z M9,7c0-1.7,1.3-3,3-3s3,1.3,3,3v2H9V7z M13.1,15.5c0,0-0.1,0.1-0.1,0.1V17c0,0.6-0.4,1-1,1s-1-0.4-1-1v-1.4c-0.6-0.6-0.7-1.5-0.1-2.1c0.6-0.6,1.5-0.7,2.1-0.1C13.6,13.9,13.7,14.9,13.1,15.5z"/>
                    
                    </g>
                    
                    </svg>
                '
                ];
                $links[] = [
                    'url' => route('admin.users.list'),
                    'label' => 'Utilisateurs',
                    'svg' => '<svg class="w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#f6f5f4">
                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                    <g id="SVGRepo_iconCarrier">
                        <g id="User / User_Circle">
                            <path id="Vector" d="M17.2166 19.3323C15.9349 17.9008 14.0727 17 12 17C9.92734 17 8.06492 17.9008 6.7832 19.3323M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21ZM12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11C15 12.6569 13.6569 14 12 14Z" stroke="#f6f5f4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </g>
                </svg>'
                ];
            }
            $links[] = [
                'url' => route('profile.edit'),
                'label' => 'Mon profil',
                'svg' => '<svg class="w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <g id="User / User_Square">
                                <path id="Vector" d="M17 21C17 18.2386 14.7614 16 12 16C9.23858 16 7 18.2386 7 21M17 21H17.8031C18.921 21 19.48 21 19.9074 20.7822C20.2837 20.5905 20.5905 20.2837 20.7822 19.9074C21 19.48 21 18.921 21 17.8031V6.19691C21 5.07899 21 4.5192 20.7822 4.0918C20.5905 3.71547 20.2837 3.40973 19.9074 3.21799C19.4796 3 18.9203 3 17.8002 3H6.2002C5.08009 3 4.51962 3 4.0918 3.21799C3.71547 3.40973 3.40973 3.71547 3.21799 4.0918C3 4.51962 3 5.08009 3 6.2002V17.8002C3 18.9203 3 19.4796 3.21799 19.9074C3.40973 20.2837 3.71547 20.5905 4.0918 20.7822C4.5192 21 5.07899 21 6.19691 21H7M17 21H7M12 13C10.3431 13 9 11.6569 9 10C9 8.34315 10.3431 7 12 7C13.6569 7 15 8.34315 15 10C15 11.6569 13.6569 13 12 13Z" stroke="#f6f5f4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </g>
                    </svg>'
            ];
            $links[] = [
                'url' => route('logout'),
                'label' => 'Déconnexion',
                'svg' => '<svg class="w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <g id="Interface / Log_Out">
                        <path id="Vector" d="M12 15L15 12M15 12L12 9M15 12H4M9 7.24859V7.2002C9 6.08009 9 5.51962 9.21799 5.0918C9.40973 4.71547 9.71547 4.40973 10.0918 4.21799C10.5196 4 11.0801 4 12.2002 4H16.8002C17.9203 4 18.4796 4 18.9074 4.21799C19.2837 4.40973 19.5905 4.71547 19.7822 5.0918C20 5.5192 20 6.07899 20 7.19691V16.8036C20 17.9215 20 18.4805 19.7822 18.9079C19.5905 19.2842 19.2837 19.5905 18.9074 19.7822C18.48 20 17.921 20 16.8031 20H12.1969C11.079 20 10.5192 20 10.0918 19.7822C9.71547 19.5905 9.40973 19.2839 9.21799 18.9076C9 18.4798 9 17.9201 9 16.8V16.75" stroke="#f6f5f4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </g>
            </svg>'
            ];
            return $links;
        }
    }
}
