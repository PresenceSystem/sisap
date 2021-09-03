<?php

Yii::import('application.models._base.BaseRecuento');

class Recuento extends BaseRecuento
{
    /**
     * @return Recuento
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Recuento|Recuentos', $n);
    }

}