<?php

Yii::import('application.models._base.BaseClaseContable');

class ClaseContable extends BaseClaseContable
{
    /**
     * @return ClaseContable
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ClaseContable|ClaseContables', $n);
    }

}