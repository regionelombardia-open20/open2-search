<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search
 * @category   CategoryName
 */

return [
    'config' => [
        'modulesEnabled' => [
           'lispa\amos\admin\AmosAdmin',
           'lispa\amos\discussioni\AmosDiscussioni',
           'lispa\amos\documenti\AmosDocumenti',
           'lispa\amos\events\AmosEvents',
           'lispa\amos\news\AmosNews',
           'lispa\amos\partnershipprofiles\Module',
           'lispa\amos\showcaseprojects\AmosShowcaseProjects',
           'lispa\amos\een\AmosEen',
           'openinnovation\organizations\OpenInnovationOrganizations',
           'lispa\amos\organizzazioni\Module',
           'lispa\amos\community\AmosCommunity',
           'lispa\amos\parternishipprofiles\Module',
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
