<?php

Yii::import('application.models._base.BaseRol');

class Rol extends BaseRol
{
    /**
     * @return Rol
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Rol|Roles', $n);
    }

}