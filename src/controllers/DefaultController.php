<?php
/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search\controllers
 * @category   CategoryName
 */

namespace lispa\amos\search\controllers;

use lispa\amos\dashboard\controllers\base\DashboardController;

class DefaultController extends DashboardController
{
    /**
     * @var string $layout Layout per la dashboard interna.
     */
    public $layout = "@vendor/lispa/amos-core/views/layouts/dashboard_interna";
    
    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
   
        return $this->redirect(['/search/search/index']);

      /*  Url::remember();

        $params = [
            'currentDashboard' => $this->getCurrentDashboard()
        ];

        return $this->render('index', $params);*/
    }
    
}
