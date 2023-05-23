<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\search
 * @category   CategoryName
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
