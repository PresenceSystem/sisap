<?php

Yii::import('application.models._base.BaseReunion');

class Reunion extends BaseReunion
{
    /**
     * @return Reunion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'reunión|reuniones', $n);
    }

}