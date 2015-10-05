<?php
namespace common\helpers;

use Yii;

class CustomHelper {
    
    public static function yesOrNo()
    {
        
            return [ 0=>['id'=>0, 'name'=>yii::t('app', 'No')],1=>['id'=>1, 'name'=>yii::t('app', 'Yes')]];
          
    }
    
}

