<?php

Yii::import('application.models._base.BaseParametro');

class Parametro extends BaseParametro
{
    /**
     * @return Parametro
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Parametro|Parametros', $n);
    }

}