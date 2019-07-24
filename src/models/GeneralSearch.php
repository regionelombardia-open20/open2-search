<?php
/**
 * Created by PhpStorm.
 * User: michele.lafrancesca
 * Date: 19/12/2018
 * Time: 10:38
 */

namespace lispa\amos\search\models;


use lispa\amos\core\behaviors\TaggableBehavior;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class GeneralSearch extends Model
{

    public $tagValues;

    public function rules()
    {
        return [
            ['tagValues','safe']
        ];
    }
}