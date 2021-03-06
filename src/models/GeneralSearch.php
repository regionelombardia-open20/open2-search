<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */
/**
 */

namespace open20\amos\search\models;


use open20\amos\core\behaviors\TaggableBehavior;
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

    public function filterRequest($toFilterRequest){

        /*
        pr('here');
        die();
        */

        /*
        pr($toFilterQueryString);
        die();
        */
        $filteredRequest = [];

        foreach($toFilterRequest as $index => $value){         
            $filteredRequest[$index] = $this->filterQueryString($value);
            //pr($filteredRequest[$index]);
        }
        
        //pr($fileterdRequest);
        //die();

        return $filteredRequest;

    }

    public function filterQueryString($stringToFilter){
       $stringToFilter = \yii\helpers\HtmlPurifier::process(trim($stringToFilter));
       $stringToFilter = strip_tags($stringToFilter);
       $stringToFilter = addslashes($stringToFilter);
        /*
       pr($stringToFilter);
        die();
        */
       return $stringToFilter;
    }

}