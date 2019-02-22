<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search\assets
 * @category   CategoryName
 */

namespace lispa\amos\search\assets;

use yii\web\AssetBundle;

/**
 * Class SearchAsset
 * @package lispa\amos\search\assets
 */
class SearchAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/lispa/amos-search/src/assets/web';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG, 
    ];

    /**
     * @inheritdoc
     */
    public $css = [
//        'css/search.css'
        'less/search.less'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/search.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];
    
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if (!empty($moduleL)) {
            $this->depends [] = 'lispa\amos\layout\assets\BaseAsset';
        } else {
            $this->depends [] = 'lispa\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }

}
