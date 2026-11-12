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

namespace open20\amos\search;

use open20\amos\core\module\AmosModule;
use open20\amos\core\module\ModuleInterface;

use Yii;

/**
 * Class AmosSearch
 * @package open20\amos\search
 */
class AmosSearch extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';
    
    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    
    public $name = 'Search';
    
    public $controllerNamespace = 'open20\amos\search\controllers';
    
    public $config = [];
    
    public $modulesToSearch = [];

    /**
     * @var bool - if true, when the scope is within a network (eg. in a community) only the network contents results are shown
     */
    public $enableNetworkScope = false;
    
    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return "search";
    }
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if(!(\Yii::$app instanceof \yii\console\Application)){
            \Yii::setAlias('@open20/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');

            // initialize the module with the configuration loaded from config.php
            $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');

            Yii::configure($this,$config);

            $this->loadEnabledModules();
        }
    }
    
    private function loadEnabledModules(){
        foreach($this->config['modulesEnabled'] as $module){
            if(class_exists($module) && in_array('open20\amos\core\interfaces\SearchModuleInterface',class_implements($module))){
                $moduleName = $module::getModuleName();
                $module = Yii::$app->getModule($moduleName);
                if(!empty($module)) {
                    $modelSearchClass = $module::getModelSearchClassName();
                    if ($moduleName && $modelSearchClass) {
                        $this->modulesToSearch[$moduleName] = $modelSearchClass;
                    }
                }
            }
        }
    }
    
    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [ 
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return [            
        ];
    }
    
    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [            
        ];
    }
        
}
