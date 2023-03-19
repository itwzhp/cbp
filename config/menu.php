<?php

use App\Domains\Visuals\Menu\MenuLink;
use App\Domains\Visuals\Menu\TagsLink;

return [
    'O CBP'                        => new MenuLink('about'),
    'Harcerski System Wychowawczy' => [
        'O HSW' => new TagsLink([
            'zasady-harcerskiego-wychowania',
            'harcerski-system-wychowawczy',
            'cechy-metody-harcerskiej',
        ]),
        //        'Grupy Wiekowe'                    => new MenuLink('materials.tags',),
        //        'System Małych Grup'               => new MenuLink('materials.tags',),
        //        'Prawa, Przyrzeczenie i Obietnica' => new MenuLink('materials.tags',),
        //        'Służba'                           => new MenuLink('materials.tags',),
        //        'System Instrumentów Metodycznych' => new MenuLink('materials.tags',),
        //        'Uczenie w działaniu'              => new MenuLink('materials.tags',),
        //        'Osobisty Przykład Instruktora'    => new MenuLink('materials.tags',),
        //        'Obrzędowość i Symbolika'          => new MenuLink('materials.tags',),
        //        'Planowanie wychowawcze'           => new MenuLink('materials.tags',),
    ],
];
