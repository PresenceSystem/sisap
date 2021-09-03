<?php

Yii::import('application.models._base.BaseMovimientoCaja');

class MovimientoCaja extends BaseMovimientoCaja
{
    /**
     * @return MovimientoCaja
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'MovimientoCaja|MovimientoCajas', $n);
    }

}