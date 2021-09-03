<?php

Yii::import('application.models._base.BaseCloracion');

class Cloracion extends BaseCloracion
{
    /**
     * @return Cloracion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Cloracion|Cloracions', $n);
    }

}