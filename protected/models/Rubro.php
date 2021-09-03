<?php

Yii::import('application.models._base.BaseRubro');

class Rubro extends BaseRubro
{
    /**
     * @return Rubro
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Rubro|Rubros', $n);
    }

}