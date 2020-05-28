<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\search
 * @category   CategoryName
 */

return [
    'config' => [
        'modulesEnabled' => [
           'open20\amos\admin\AmosAdmin',
           'open20\amos\discussioni\AmosDiscussioni',
           'open20\amos\documenti\AmosDocumenti',
           'open20\amos\events\AmosEvents',
           'open20\amos\news\AmosNews',
           'open20\amos\partnershipprofiles\Module',
           'open20\amos\showcaseprojects\AmosShowcaseProjects',
           'open20\amos\een\AmosEen',
           'openinnovation\organizations\OpenInnovationOrganizations',
           'open20\amos\organizzazioni\Module',
           'open20\amos\community\AmosCommunity',
           'open20\amos\parternishipprofiles\Module',
       ],
    ],
    'params' => [
        //active the search
        'searchParams' => [
        ],
        //active the order
        'orderParams' => [
        ],
    ]
];
