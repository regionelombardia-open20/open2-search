<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search
 * @category   CategoryName
 */

namespace lispa\amos\search;

use lispa\amos\core\module\AmosModule;
use lispa\amos\core\module\ModuleInterface;

use Yii;

/**
 * Class AmosSearch
 * @package lispa\amos\search
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
    
    public $controllerNamespace = 'lispa\amos\search\controllers';
    
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
        
        \Yii::setAlias('@lispa/amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        
        // initialize the module with the configuration loaded from config.php
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
        
        Yii::configure($this,$config);
        
        $this->loadEnabledModules();
    }
    
    private function loadEnabledModules(){
        foreach($this->config['modulesEnabled'] as $module){
            if(class_exists($module) && in_array('lispa\amos\core\interfaces\SearchModuleInterface',class_implements($module))){
                $modelName = $module::getModuleName();
                if(!empty(Yii::$app->getModule($modelName))) {
                    $modelSearchClass = $module::getModelSearchClassName();
                    if ($modelName && $modelSearchClass) {
                        $this->modulesToSearch[$modelName] = $modelSearchClass;
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
