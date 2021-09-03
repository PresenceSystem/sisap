<?php

Yii::import('application.models._base.BaseEstado');

class Estado extends BaseEstado
{
    /**
     * @return Estado
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Estado|Estados', $n);
    }

}