<?php

Yii::import('application.models._base.BaseImpresora');

class Impresora extends BaseImpresora
{
    /**
     * @return Impresora
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Impresora|Impresoras', $n);
    }

}