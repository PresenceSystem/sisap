<?php

Yii::import('application.models._base.BaseMedidor');

class Medidor extends BaseMedidor
{
    /**
     * @return Medidor
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Medidor|Medidors', $n);
    }

}