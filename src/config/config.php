<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\search
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
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
