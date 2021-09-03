<?php

Yii::import('application.models._base.BaseImpresion');

class Impresion extends BaseImpresion
{
    /**
     * @return Impresion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Impresion|Impresions', $n);
    }

}