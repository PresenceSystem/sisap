<?php

Yii::import('application.models._base.BaseCuentaContable');

class CuentaContable extends BaseCuentaContable
{
    /**
     * @return CuentaContable
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'CuentaContable|CuentaContables', $n);
    }

}