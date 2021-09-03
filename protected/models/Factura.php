<?php

Yii::import('application.models._base.BaseFactura');

class Factura extends BaseFactura
{
    /**
     * @return Factura
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Factura|Facturas', $n);
    }

}