<?php

Yii::import('application.models._base.BaseDetalle');

class Detalle extends BaseDetalle
{
    /**
     * @return Detalle
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Detalle|Detalles', $n);
    }

}