<?php

Yii::import('application.models._base.BaseCaja');

class Caja extends BaseCaja
{
    /**
     * @return Caja
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Caja|Cajas', $n);
    }

}